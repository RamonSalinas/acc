<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\AdCursos;
use Illuminate\Contracts\View\View; // Importar a classe View

class NomeCursoWidgetStats extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    
    protected function getStats(): array
    {
        // Fetch users and their roles
        $users = User::with('roles')->get(['id', 'id_curso', 'is_active']);
        
        // Get the list of course IDs
        $idCursos = $users->pluck('id_curso')->toArray();
        
        // Take the first course ID for demonstration
        $firstIdCurso = $idCursos[0] ?? null;

        // Fetch the course details from AdCursos using the firstIdCurso
        $cursoDetails = AdCursos::where('id', $firstIdCurso)->first();

        // Initialize variables to store course details
        $nomeCurso = $cursoDetails->nome_curso ?? 'N/A';
        $cargaHorariaCurso = $cursoDetails->carga_horaria_curso ?? 'N/A';
        $cargaHorariaACC = $cursoDetails->carga_horaria_ACC ?? 'N/A';
        $cargaHorariaExtensao = $cursoDetails->carga_horaria_Extensao ?? 'N/A';

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
