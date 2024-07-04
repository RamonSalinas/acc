<?php

namespace App\Filament\Widgets;

use App\Models\NgCertificados;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use App\Models\NgAtividades;
use Illuminate\Support\Facades\Auth;

class ActivityGroupChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;

    public function getHeading(): string|Htmlable|null
    {
        return __('Contagem de Tipos de Atividades');
    }

    protected function getData(): array
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

        $certificados = $query->get();

        // Carregar todas as atividades para mapear posteriormente
        $atividades = NgAtividades::all()->keyBy('id');

        // Agrupar certificados pelo grupo_atividades
        $atividadeCounts = $certificados->groupBy(function ($certificado) use ($atividades) {
            $atividade = $atividades->get($certificado->id_tipo_atividade);
            return $atividade ? $atividade->grupo_atividades : 'Desconhecido';
        })->map(function ($rows) {
            return $rows->sum('horas_ACC');
        });

        $labels = $atividadeCounts->keys()->toArray();

        // Mapear os rótulos conforme as condições especificadas
        $labels = array_map(function ($label) {
            switch ($label) {
                case 1:
                    return 'Ensino';
                case 2:
                    return 'Pesquisa';
                case 3:
                    return 'Atividades';
                case 4:
                    return 'Representação';
                case 5:
                    return 'Iniciação';
                case 6:
                    return 'Participação';
                case 7:
                    return 'Cultural';
                case 8:
                    return 'Extensão';
                default:
                    return 'Desconhecido';
                
            }
        }, $labels);

        $data = $atividadeCounts->values()->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
