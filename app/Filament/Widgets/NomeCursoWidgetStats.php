<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AdCursos;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NomeCursoWidgetStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        // Fetch the first user with their roles
        $user = Auth::user();

        // Initialize variables to store course details or default message
        $nomeCurso = 'Curso ainda não registrado, registre o curso antes de iniciar.';
        $cargaHorariaCurso = 'N/A';
        $cargaHorariaACC = 'N/A';
        $cargaHorariaExtensao = 'N/A';

        // Check if the user's id_curso is filled
        if ($user && !is_null($user->id_curso)) {
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
            Stat::make(__('Nome do Curso'), $nomeCurso),
            Stat::make(__('Carga Horária do Curso'), $cargaHorariaCurso),
            Stat::make(__('Carga Horária ACC'), $cargaHorariaACC),
            Stat::make(__('Carga Horária Extensão'), $cargaHorariaExtensao),
        ];
    }

    public function render(): View
    {
        $stats = $this->getStats();

        return view('filament.widgets.nome-curso-widget-stats', [
            'nomeCurso' => $stats[0]->getValue(),
            'cargaHorariaCurso' => $stats[1]->getValue(),
            'cargaHorariaACC' => $stats[2]->getValue(),
            'cargaHorariaExtensao' => $stats[3]->getValue(),
        ]);
    }
}
