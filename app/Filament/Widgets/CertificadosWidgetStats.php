<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\NgCertificados;
use Illuminate\Support\Facades\Auth;

class CertificadosWidgetStats extends Widget
{
    protected static string $view = 'filament.widgets.certificados-widget-stats';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $query = NgCertificados::query();

        if (!$user->isSuperAdmin()) {
            if ($user->isAdmin()) {
                $query->whereHas('user', function ($q) use ($user) {
                    $q->where('id_professor', $user->id);
                });
            } else {
                $query->where('id_usuario', $user->id);
            }
        }

        $totalCertificados = $query->count();
        $totalCargaHoraria = $query->sum('carga_horaria');
        $totalHorasACC = $query->sum('horas_ACC');

        return [
            'totalCertificados' => $totalCertificados,
            'totalCargaHoraria' => $totalCargaHoraria,
            'totalHorasACC' => $totalHorasACC,
        ];
    }
}
