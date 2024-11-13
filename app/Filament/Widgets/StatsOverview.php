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
        // Fetch the currently authenticated user
        $user = Auth::user();

        $certificadosQuery = NgCertificados::query();

        // Filter certificados based on user roles
        if (!$user->isSuperAdmin()) {
            if ($user->isAdmin()) {
                $certificadosQuery->whereHas('user', function ($q) use ($user) {
                    $q->where('id_professor', $user->id);
                });
            } else {
                $certificadosQuery->where('id_usuario', $user->id);
            }
        }

        // Calculate totals for certificados
        $totalCertificados = $certificadosQuery->count();
        $totalCargaHoraria = $certificadosQuery->sum('carga_horaria');
        $certificadosQueryACC = clone $certificadosQuery;
        $certificadosQueryExtensao = clone $certificadosQuery;

        // Calculate total hours excluding id_tipo_atividade = 10
        $totalHorasACC = $certificadosQueryACC->where('id_tipo_atividade', '!=', 10)->sum('horas_ACC');

        // Calculate total hours for id_tipo_atividade = 10
        $totalHorasExtensao = $certificadosQueryExtensao->where('id_tipo_atividade', 10)->sum('horas_ACC');
        // Fetch users and their roles
        
        $users = User::with('roles')->get(['id', 'id_curso', 'is_active']);

        // Calculate user statistics
        $totalCount = $users->count();
        $totalAdmins = $users->filter(function ($user) {
            return $user->roles->contains('name', 'Admin');
        })->count();
        $totalActiveUsers = $users->filter(function ($user) {
            return $user->is_active;
        })->count();

        // Initialize variables to store course details
        $nomeCurso = 'N/A';
        $cargaHorariaCurso = 'N/A';
        $cargaHorariaACC = 'N/A';
        $cargaHorariaExtensao = 'N/A';

        // Check if the user's id_curso is filled
        if (!is_null($user->id_curso)) {
            // Fetch the course details from AdCursos using the user's id_curso
            $cursoDetails = AdCursos::where('id', $user->id_curso)->first();
            // If course details are found, update the variables
            if ($cursoDetails) {
                $nomeCurso = $cursoDetails->nome_curso;
                $cargaHorariaCurso = $cursoDetails->carga_horaria_curso;
                $cargaHorariaACC = $cursoDetails->carga_horaria_ACC;
                $cargaHorariaExtensao = $cursoDetails->carga_horaria_Extensao;
            }
        }

        // Return the stats array
        return [
 
            Stat::make(__('Hora Extensão Registradas'), $totalHorasExtensao),
            Stat::make(__('Certificados'), $totalCertificados),
            Stat::make(__('Horas ACC Registradas'), $totalHorasACC),
        ];
    }
}
