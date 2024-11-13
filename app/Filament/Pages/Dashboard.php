<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UserJoinChart;
use Filament\Widgets\AccountWidget;
use App\Filament\Widgets\NomeCursoWidgetStats;
use App\Filament\Widgets\CertificadosWidgetStats;
use App\Filament\Widgets\ActivityGroupChart;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            NomeCursoWidgetStats::class,
           // AccountWidget::class,
            StatsOverview::class,
            //CertificadosWidgetStats::class,
           // UserJoinChart::class,
            ActivityGroupChart::class,


        ];
    }
}
