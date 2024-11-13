<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class ActivityChartWidget extends Widget
{
    protected static string $view = 'filament.widgets.activity-chart-widget';

    protected function getData(): array
    {
        // Query para obter os dados da tabela "Contagem de Tipos de Atividades"
        $activityCounts = DB::table('ng_certificados')
            ->join('ng_atividades', 'ng_certificados.id_tipo_atividade', '=', 'ng_atividades.id')
            ->select('ng_atividades.grupo_atividades as group', DB::raw('count(ng_certificados.id) as count'))
            ->groupBy('ng_atividades.grupo_atividades')
            ->get();

        return [
            'labels' => $activityCounts->pluck('group'),
            'data' => $activityCounts->pluck('count'),
        ];
    }
}
