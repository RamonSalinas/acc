<?php

namespace App\Http\Controllers;

use App\Models\NgCertificadosProgressao;
use App\Models\AdGrupoProgressao;
use App\Models\Professor;
use App\Models\Progressao;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressaoController extends Controller
{

    public function imprimirRelatorioAvaliacao($progressaoId)
    {
        $userId = auth()->id();
        $usuario = Auth::user();

        $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
            $query->where('id_usuario', $userId)
                  ->where('progressao_id', $progressaoId);
        }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();

        $progressao = Progressao::find($progressaoId);
        $professor = Professor::find($progressao->professor_id);
        $pdf = Pdf::loadView('pdf.progressao.relatorioavaliacao', compact('grupos', 'progressao', 'usuario', 'professor'))->setPaper('a4', 'landscape');
        return $pdf->download('relatorioavaliacao.pdf');
    }

    public function imprimirRelatorio($tipo, $progressaoId = null)
{
    $userId = auth()->id();
    $usuario = Auth::user();

   
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

            case 'relatorioavaliacao':
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
                $progressao = Progressao::find($progressaoId);
                $professor = Professor::where('user_id', $userId)->first(); // Adicione esta linha
                
                $pdf = Pdf::loadView('pdf.progressao.relatorioavaliacao', compact('grupos', 'progressao', 'usuario', 'professor'))->setPaper('a4', 'landscape');
                return $pdf->download('relatorioavaliacao.pdf');

        case 'contar_relatorios':
            $count = Progressao::count();
            return view('pdf.progressao.contar_relatorios', compact('count'));

        case 'relatorios_usuario':
            $progressao = Progressao::find($progressaoId);


            $professor = Professor::where('user_id', $userId)->first();
            $nomeProfessor = $professor->user->name;


            $dataAtual = now();
            $pdf = Pdf::loadView('pdf.progressao.relatorios_usuario', compact('progressao', 'professor', 'dataAtual', 'nomeProfessor'));
            return $pdf->download('relatorios_usuario.pdf');

        default:
            return abort(404, 'Tipo de relatório não encontrado');
    }
}

}