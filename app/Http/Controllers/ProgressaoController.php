<?php

namespace App\Http\Controllers;

use App\Models\NgCertificadosProgressao;
use App\Models\AdGrupoProgressao;
use App\Models\Progressao;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressaoController extends Controller
{
    public function imprimirRelatorio($tipo, $progressaoId = null)
    {
        $userId = auth()->id();
        $usuario = Auth::user(); // Assuming you are using Laravel's Auth system


        if (is_numeric($tipo)) {//Validar se o tipo é um número para criar o relatorio exacto da progressão solicitada. 
            $progressaoId = $tipo;
            $tipo = 'analises';
       } 



        switch ($tipo) {
            case 'todos_certificados':
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId) {
                    $query->where('id_usuario', $userId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
                $pdf = Pdf::loadView('pdf.progressao.todos_certificados', compact('grupos'))->setPaper('a4', 'landscape');
                return $pdf->download('todos_certificados.pdf');

            case 'analises':
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();


                $progressao = Progressao::find($progressaoId);

                $pdf = Pdf::loadView('pdf.progressao.analises', compact('grupos', 'progressao', 'usuario'));
                return $pdf->download('analises.pdf');
              

            case 'contar_relatorios':
                $count = Progressao::count();
                return view('pdf.progressao.contar_relatorios', compact('count'));

            case 'relatorios_usuario':
                $progressaos = Progressao::where('professor_id', $userId)->get();
                $pdf = Pdf::loadView('pdf.progressao.relatorios_usuario', compact('progressaos'));
                return $pdf->download('relatorios_usuario.pdf');

            default:
                return abort(404, 'Tipo de relatório não encontrado');
        }
    }
}