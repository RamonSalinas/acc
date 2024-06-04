<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\NgCertificados;
use App\Models\AdCursos;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected function getStats(): array
    {

        $user = Auth::user();
        $certificadosQuery = NgCertificados::query();

        if (!$user->isSuperAdmin()) {
            if ($user->isAdmin()) {
                $certificadosQuery->whereHas('user', function ($q) use ($user) {
                    $q->where('id_professor', $user->id);
                });
            } else {
                $certificadosQuery->where('id_usuario', $user->id);
            }
        }

        $totalCertificados = $certificadosQuery->count();
        $totalCargaHoraria = $certificadosQuery->sum('carga_horaria');
        $totalHorasACC = $certificadosQuery->sum('horas_ACC');

        $users = User::with('roles')->get(['id', 'id_curso', 'is_active']);
        $idCursos = $users->pluck('id_curso')->toArray();
        $firstIdCurso = $idCursos[0] ?? null;

        $totalCount = $users->count();
        $totalAdmins = $users->filter(function ($user) {
            return $user->roles->contains('name', 'Admin');
        })->count();
        $totalActiveUsers = $users->filter(function ($user) {
            return $user->is_active;
        })->count();

        $cursoDetails = AdCursos::where('id', $firstIdCurso)->first();

        // Initialize variables to store course details
        $nomeCurso = $cursoDetails->nome_curso ?? 'N/A';
        $cargaHorariaCurso = $cursoDetails->carga_horaria_curso ?? 0;
        $cargaHorariaACC = $cursoDetails->carga_horaria_ACC ?? 0;
        $cargaHorariaExtensao = $cursoDetails->carga_horaria_Extensao ?? 0;

        return [
           //  Stat::make(__('Nome do Curso'), $nomeCurso),
           //  Stat::make(__('Carga Horária do Curso'), $cargaHorariaCurso),
            //Stat::make(__('Carga Horária ACC'), $cargaHorariaACC),
             Stat::make(__('Carga Horária Extensão'), $cargaHorariaExtensao),
            // Stat::make(__('Primeiro ID Curso'), $firstIdCurso),
            // Stat::make(__('Horas do Curso'), $totalActiveUsers),
            Stat::make(__('Certificados'), $totalCertificados),
            Stat::make(__('Horas ACC Registradas'), $totalHorasACC),
          //  Stat::make(__('widgets.stat.total_user'), $totalCertificados),
           // Stat::make(__('widgets.stat.total_admin'), $totalAdmins),
         //   Stat::make(__('widgets.stat.total_active_user'), $totalActiveUsers),
        ];
    }
}
