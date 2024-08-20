<?php

namespace App\Http\Controllers;

use App\Models\NgCertificadosProgressao;
use App\Models\AdGrupoProgressao;
use App\Models\Professor;
use App\Models\Progressao;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PontosProgressao;

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
        case 'Parecer_Conclusivo':
            $count = Progressao::count();
            $progressao = Progressao::find($progressaoId);
            $professorID = $progressao->professor_id;
            $professor = Professor::where('id', $professorID)->first();
            $professorIDuser=$professor->user_id;
            $user = User::where('id', $professorIDuser)->first();
            $userId=$user->id;// Id do professor da Progressão Para imprimir o relatorio e dados certos
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
               // $progressao = Progressao::find($progressaoId);
               
               // $professor = Professor::where('user_id', $userId)->first(); // Adicione esta linha
               $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                $query->where('id_usuario', $userId)
                      ->where('progressao_id', $progressaoId);
            }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
            
            $aprovadoPorGrupo = [];
            $pendenteRejeitadaPorGrupo = [];
            
            // Iterar sobre os grupos e calcular as somas
            foreach ($grupos as $grupo) {
                $aprovadoPorGrupo[$grupo->id] = 0.0;
                $pendenteRejeitadaPorGrupo[$grupo->id] = 0.0;
            
                foreach ($grupo->ngCertificadosProgressao as $certificado) {
                    $pontuacao = floatval($certificado->pontuacao_avaliador);
                    if ($certificado->status == 'Aprovado') {
                        $aprovadoPorGrupo[$grupo->id] += $pontuacao;
                    } elseif ($certificado->status == 'Pendente' || $certificado->status == 'Rejeitada') {
                        $pendenteRejeitadaPorGrupo[$grupo->id] += $pontuacao;
                    }
                }
            }
            
            // Garantir que grupos sem certificados tenham valor 0
            foreach ($grupos as $grupo) {
                if (!isset($aprovadoPorGrupo[$grupo->id])) {
                    $aprovadoPorGrupo[$grupo->id] = 0.0;
                }
                if (!isset($pendenteRejeitadaPorGrupo[$grupo->id])) {
                    $pendenteRejeitadaPorGrupo[$grupo->id] = 0.0;
                }
            }
               
               
               
               
               
               
      
            $dataAtual = now();

               $nomeProfessor = $user->name;// Nome do professor da Progressão
             //   $pdf = Pdf::loadView('pdf.progressao.relatorioavaliacao', compact('grupos', 'progressao', 'usuario', 'professor','nomeProfessor'));
            $pdf = Pdf::loadView('pdf.progressao.todos_certificados', compact('grupos', 'progressao', 'usuario', 'professor','dataAtual','nomeProfessor','aprovadoPorGrupo', 'pendenteRejeitadaPorGrupo'));
            //$pdf = Pdf::loadView('', compact('grupos'));
            return $pdf->download('todos_certificados.pdf');

            case 'analises':
                $progressao = Progressao::find($progressaoId);
                $professorID = $progressao->professor_id;
                $professor = Professor::where('id', $professorID)->first();
                $professorIDuser = $professor->user_id;
                $user = User::where('id', $professorIDuser)->first();
                $userId = $user->id; // Id do professor da Progressão Para imprimir o relatorio e dados certos
            
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
                
                $nomeProfessor = $user->name; // Nome do professor da Progressão
            
                // Calcular totalPontuacaoAvaliador
                $totalPontuacaoAvaliadorController = 0.0;
                foreach ($grupos as $grupo) {
                    foreach ($grupo->ngCertificadosProgressao as $certificado) {
                        if ($certificado->status != 'Pendente' && $certificado->status != 'Rejeitada') {
                            $totalPontuacaoAvaliadorController += floatval($certificado->pontuacao_avaliador);
                        }
                    }
                }
           // dd($totalPontuacaoAvaliador);
                $pdf = Pdf::loadView('pdf.progressao.analises', compact('grupos', 'progressao', 'usuario', 'nomeProfessor', 'totalPontuacaoAvaliadorController'));
                return $pdf->download('analises.pdf');

            case 'relatorioavaliacao':
            $progressao = Progressao::find($progressaoId);
            $professorID = $progressao->professor_id;
            $professor = Professor::where('id', $professorID)->first();
            $professorIDuser=$professor->user_id;
            $user = User::where('id', $professorIDuser)->first();
            $userId=$user->id;// Id do professor da Progressão Para imprimir o relatorio e dados certos
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
               // $progressao = Progressao::find($progressaoId);
               
               // $professor = Professor::where('user_id', $userId)->first(); // Adicione esta linha
            $nomeProfessor = $user->name;// Nome do professor da Progressão

            $totalPontuacaoAvaliadorController = 0.0;
                foreach ($grupos as $grupo) {
                    foreach ($grupo->ngCertificadosProgressao as $certificado) {
                        if ($certificado->status != 'Pendente' && $certificado->status != 'Rejeitada') {
                            $totalPontuacaoAvaliadorController += floatval($certificado->pontuacao_avaliador);
                        }
                    }
                }
               // $pontosProgressao = PontosProgressao::all();
                // Obtenha os pontos da progressão que correspondem à classe e nível da progressão
                $pontosProgressao = PontosProgressao::where('classe', $progressao->classe)
                ->where('nivel', $progressao->nivel)
                ->first();

                // Verifique se há correspondência e defina o valor dos pontos ou "N/A"
                $pontos = $pontosProgressao ? $pontosProgressao->pontos : 'N/A';


                //dd($pontos);
                $pdf = Pdf::loadView('pdf.progressao.relatorioavaliacao', compact('grupos', 'progressao', 'usuario', 'professor', 'nomeProfessor', 'totalPontuacaoAvaliadorController', 'pontos'))->setPaper('a4', 'landscape');
                return $pdf->download('relatorioavaliacao.pdf');

        case 'contar_relatorios':
            $count = Progressao::count();
            $progressao = Progressao::find($progressaoId);
            $professorID = $progressao->professor_id;
            $professor = Professor::where('id', $professorID)->first();
            $professorIDuser=$professor->user_id;
            $user = User::where('id', $professorIDuser)->first();
            $userId=$user->id;// Id do professor da Progressão Para imprimir o relatorio e dados certos
                $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                    $query->where('id_usuario', $userId)
                          ->where('progressao_id', $progressaoId);
                }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
               // $progressao = Progressao::find($progressaoId);
               
               // $professor = Professor::where('user_id', $userId)->first(); // Adicione esta linha
               $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
                $query->where('id_usuario', $userId)
                      ->where('progressao_id', $progressaoId);
            }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();
            
            $aprovadoPorGrupo = [];
            $pendenteRejeitadaPorGrupo = [];
            
            // Iterar sobre os grupos e calcular as somas
            foreach ($grupos as $grupo) {
                $aprovadoPorGrupo[$grupo->id] = 0.0;
                $pendenteRejeitadaPorGrupo[$grupo->id] = 0.0;
            
                foreach ($grupo->ngCertificadosProgressao as $certificado) {
                    $pontuacao = floatval($certificado->pontuacao_avaliador);
                    if ($certificado->status == 'Aprovado') {
                        $aprovadoPorGrupo[$grupo->id] += $pontuacao;
                    } elseif ($certificado->status == 'Pendente' || $certificado->status == 'Rejeitada') {
                        $pendenteRejeitadaPorGrupo[$grupo->id] += $pontuacao;
                    }
                }
            }
            
            // Garantir que grupos sem certificados tenham valor 0
            foreach ($grupos as $grupo) {
                if (!isset($aprovadoPorGrupo[$grupo->id])) {
                    $aprovadoPorGrupo[$grupo->id] = 0.0;
                }
                if (!isset($pendenteRejeitadaPorGrupo[$grupo->id])) {
                    $pendenteRejeitadaPorGrupo[$grupo->id] = 0.0;
                }
            }
               
            $pontosProgressao = PontosProgressao::where('classe', $progressao->classe)
            ->where('nivel', $progressao->nivel)
            ->first();

            // Verifique se há correspondência e defina o valor dos pontos ou "N/A"
            $pontos = $pontosProgressao ? $pontosProgressao->pontos : 'N/A'; 
               
               
               
               
      
            $dataAtual = now();

               $nomeProfessor = $user->name;// Nome do professor da Progressão
             //   $pdf = Pdf::loadView('pdf.progressao.relatorioavaliacao', compact('grupos', 'progressao', 'usuario', 'professor','nomeProfessor'));
            $pdf = Pdf::loadView('pdf.progressao.contar_relatorios', compact('grupos', 'progressao', 'usuario', 'professor','dataAtual','nomeProfessor','aprovadoPorGrupo', 'pendenteRejeitadaPorGrupo','pontos'));
            return $pdf->download('RelatoriosDesempenho.pdf');


        case 'relatorios_usuario':
            $progressao = Progressao::find($progressaoId);


            $professor = Professor::where('user_id', $userId)->first();
            $nomeProfessor = $professor->user->name;


            $dataAtual = now();
            $pdf = Pdf::loadView('pdf.progressao.relatorios_usuario', compact('progressao', 'professor', 'dataAtual', 'nomeProfessor'));
            return $pdf->download('relatorios_usuario.pdf');

            case 'portaria':
                $progressao = Progressao::find($progressaoId);
                $professor = Professor::find($progressao->professor_id);
                $pdf = Pdf::loadView('pdf.progressao.portaria', compact('progressao', 'professor', 'usuario'))->setPaper('a4', 'landscape');
                return $pdf->download('portaria.pdf');

         ;      
        
        
            default:
            return abort(404, 'Tipo de relatório não encontrado');
    }
}

}