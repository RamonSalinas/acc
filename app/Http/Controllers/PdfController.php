<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\NgCertificados;
use Illuminate\Http\Request;
use App\Models\NgAtividades;
use App\Models\AdCursos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Psy\Readline\Hoa\Console;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;

class PdfController extends Controller
{
    public function generatePdf()
{
    $user = Auth::user();
    // dd($user, $user->id); // Exibe o objeto $user e o ID do usuário

    $curso = AdCursos::find($user->id_curso);

    // Verificar se o usuário tem o curso registrado
    if (!$curso) {
        return Redirect::route('error');
    }


     // Chamar a função para unificar os PDFs
     $unificadoPath = $this->unificarCertificadosInterno();

     // Verificar se o arquivo unificado foi gerado
     if (!file_exists($unificadoPath)) {
         abort(500, 'Erro ao gerar o arquivo PDF unificado.');
     }
 

    // Verificar se o usuário é super administrador
    if ($user->isSuperAdmin()) {
        // Se o usuário for super administrador, pode ver todos os certificados
        $certificados = NgCertificados::with(['ngAtividade', 'user'])->get();
    } else {
        // Se o usuário for administrador
        if ($user->isAdmin()) {
            // Mostrar certificados cujo id_usuario seja igual ao seu ID
            $certificados = NgCertificados::with(['ngAtividade', 'user'])
                ->where(function ($query) use ($user) {
                    $query->where('id_usuario', $user->id)
                        ->orWhereHas('user', function ($query) use ($user) {
                            $query->where('id_professor', $user->id);
                        });
                })
                ->get();


        } else {
            // Se o usuário não for administrador, mostrar apenas seus próprios certificados
            $certificados = NgCertificados::with(['ngAtividade', 'user'])
                                          ->where('id_usuario', $user->id)
                                          ->get();
        }
    }
    

    $pdf = Pdf::loadView('pdf.certificados', compact('certificados', 'user', 'curso'))
              ->setPaper('a4', 'landscape');  // Set the orientation to landscape

    return $pdf->download('certificados.pdf');
}



private function unificarCertificadosInterno()
{
    $certificados = $this->getCertificados();
    $outputPath = public_path('storage/unificado.pdf'); // Caminho do PDF final unificado

    // Crie um novo PDF com FPDI
    $pdf = new Fpdi();

    // Adicione o PDF recém-criado
    $pdfRecemCriado = public_path('storage/certificados_recem_criado.pdf'); // Substitua pelo caminho do PDF gerado
    if (file_exists($pdfRecemCriado)) {
        $pageCount = $pdf->setSourceFile($pdfRecemCriado);
        for ($i = 1; $i <= $pageCount; $i++) {
            $tplIdx = $pdf->importPage($i);
            $size = $pdf->getTemplateSize($tplIdx);

            // Ajustar a orientação com base no tamanho da página
            $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';
            $pdf->AddPage($orientation);
            $pdf->useTemplate($tplIdx);
        }
    }

    // Adicione os PDFs e imagens de $certificado->arquivo
    foreach ($certificados as $certificado) {
        if ($certificado->arquivo) {
            $filePath = public_path('storage/' . $certificado->arquivo);
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

            if (file_exists($filePath)) {
                if ($fileExtension === 'pdf') {
                    // Adicionar páginas de PDF
                    $pageCount = $pdf->setSourceFile($filePath);
                    for ($i = 1; $i <= $pageCount; $i++) {
                        $tplIdx = $pdf->importPage($i);
                        $size = $pdf->getTemplateSize($tplIdx);

                        // Ajustar a orientação com base no tamanho da página
                        $orientation = ($size['width'] > $size['height']) ? 'L' : 'P';
                        $pdf->AddPage($orientation);
                        $pdf->useTemplate($tplIdx);
                    }
                } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                    // Adicionar imagens
                    list($width, $height) = getimagesize($filePath);

                    // Converter dimensões para milímetros (FPDF usa mm)
                    $widthMm = $width * 0.264583; // 1 pixel = 0.264583 mm
                    $heightMm = $height * 0.264583;

                    // Ajustar a orientação com base no tamanho da imagem
                    $orientation = ($widthMm > $heightMm) ? 'L' : 'P';
                    $pdf->AddPage($orientation);

                    // Adicionar a imagem ao PDF
                    $pdf->Image($filePath, 10, 10, $widthMm > 190 ? 190 : $widthMm); // Limitar largura a 190mm
                }
            }
        }
    }

    // Salve o PDF unificado
    $pdf->Output($outputPath, 'F'); // Salva o arquivo no servidor

    return $outputPath; // Retorna o caminho do arquivo unificado
}

private function getCertificados($user = null)
{

    $user = $user ?? Auth::user();

    if (!$user) {
        abort(403, 'Usuário não autenticado.');
    }


    // Verificar se o usuário é super administrador
    if ($user->isSuperAdmin()) {
        // Retornar todos os certificados
        return NgCertificados::with(['ngAtividade', 'user'])->get();
    }

    // Verificar se o usuário é administrador
    if ($user->isAdmin()) {
        // Retornar certificados do próprio administrador ou de usuários associados a ele
        return NgCertificados::with(['ngAtividade', 'user'])
            ->where(function ($query) use ($user) {
                $query->where('id_usuario', $user->id)
                    ->orWhereHas('user', function ($query) use ($user) {
                        $query->where('id_professor', $user->id);
                    });
            })
            ->get();
    }

    // Caso contrário, retornar apenas os certificados do próprio usuário
    return NgCertificados::with(['ngAtividade', 'user'])
        ->where('id_usuario', $user->id)
        ->get();
}



public function unificarCertificados()
{
    $certificados = $this->getCertificados();
    $outputPath = public_path('storage/unificado.pdf'); // Caminho do PDF final unificado

    // Crie um novo PDF com FPDI
    $pdf = new Fpdi();

    // Adicione o PDF recém-criado
    $pdfRecemCriado = public_path('storage/certificados_recem_criado.pdf'); // Substitua pelo caminho do PDF gerado
    if (file_exists($pdfRecemCriado)) {
        $pageCount = $pdf->setSourceFile($pdfRecemCriado);
        for ($i = 1; $i <= $pageCount; $i++) {
            $tplIdx = $pdf->importPage($i);
            $pdf->AddPage();
            $pdf->useTemplate($tplIdx);
        }
    }

    // Adicione os PDFs de $certificado->arquivo
    foreach ($certificados as $certificado) {
        if ($certificado->arquivo) {
            $filePath = public_path('storage/' . $certificado->arquivo);
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            // Verifique se o arquivo é um PDF
            if (file_exists($filePath) && $fileExtension === 'pdf') {
                $pageCount = $pdf->setSourceFile($filePath);
                for ($i = 1; $i <= $pageCount; $i++) {
                    $tplIdx = $pdf->importPage($i);
                    $pdf->AddPage();
                    $pdf->useTemplate($tplIdx);
                }
            }
        }
    }

    // Salve o PDF unificado
    $pdf->Output($outputPath, 'F'); // Salva o arquivo no servidor

    // Retorne o PDF unificado para download
    return response()->download($outputPath);
}







public function generatePdf1()
    {
        
        $user = Auth::user();
        $curso = AdCursos::find($user->id_curso);

        if (!$curso) {
            return Redirect::route('error');
        }

     //   $query = NgCertificados::with(['ngAtividade', 'user']);
     $query = NgCertificados::with(['ngAtividade', 'user'])
    ->join('ng_atividades', 'ng_certificados.id_tipo_atividade', '=', 'ng_atividades.id')
    ->join('ad_grupo', 'ng_atividades.grupo_atividades', '=', 'ad_grupo.id')
    ->select('ng_certificados.*', 'ng_atividades.grupo_atividades as grupo_atividades', 'ad_grupo.nome_grupo as nome_grupo_atividades'
);

        if (!$user->isSuperAdmin()) {
            if ($user->isAdmin()) {
                $query->whereHas('user', function ($q) use ($user) {
                    $q->where('id_professor', $user->id);
                });
            } else {
                $query->where('id_usuario', $user->id);
            }
        }

        $query->orderBy('ng_atividades.grupo_atividades');


        $certificados = $query->get();

        //dd($certificados); // Visualizar os resultados

        $totalCertificados = $certificados->count();
        // Supondo que você já tenha a coleção $certificados
        if ($certificados->isNotEmpty()) {
            $discente = $certificados->first()->user;
        } else {
            $discente = 'null'; // ou uma instância padrão de User, dependendo da sua lógica
        }
           $atividadeCounts = $certificados->groupBy('id_tipo_atividade')
        ->map(function ($rows) use ($curso) {
            $count = $rows->count();
            $horas_acc_sum = $rows->sum('horas_ACC');
            $atividade = NgAtividades::find($rows->first()->id_tipo_atividade);
            $percentual_maximo = $atividade ? $atividade->percentual_maximo : 0;

            $maxHorasPermitidas = $atividade && $atividade->id === 10
                ? ($percentual_maximo * $curso->carga_horaria_Extensao) / 100
                : ($percentual_maximo * $curso->carga_horaria_ACC) / 100;

            $horasExcedentes = $horas_acc_sum > $maxHorasPermitidas ? $horas_acc_sum - $maxHorasPermitidas : 0;
            $horasValidas = min($horas_acc_sum, $maxHorasPermitidas);
            $horasRestantes = max($maxHorasPermitidas - $horas_acc_sum, 0);

            $comparacao = $horas_acc_sum > $maxHorasPermitidas
                ? "Alcançou o máximo de horas permitidas para integralizar neste tipo de atividade. Horas não consideradas: {$horasExcedentes}"
                : "Faltam {$horasRestantes} horas para alcançar o máximo permitido neste tipo de ativida:)";

            return [
                'count' => $count,
                'horas_acc_sum' => $horasValidas,
                'horasExcedentes' => $horasExcedentes,
                'percentual_maximo' => $percentual_maximo,
                'maxHorasPermitidas' => $maxHorasPermitidas,
                'comparacao' => $comparacao,
                'atividade' => $atividade,
            ];
        })
        //->sortDesc(); Ordem de grupos de atividades por ordem crescente
        ->sortBy('created_at');

        // Calcular a soma total das horas ACC e das horas de extensão
        $totalHorasACC = $certificados->where('id_tipo_atividade', '!=', 10)->sum('horas_ACC');
        $totalHorasExtensao = $certificados->where('id_tipo_atividade', 10)->sum('horas_ACC');
       /* $totalHorasACC = $certificados->where('id_tipo_atividade', '!=', 10)->sum(function ($certificado) use ($atividadeCounts) {
            return $atividadeCounts[$certificado->id_tipo_atividade]['horas_acc_sum'];
        });

        $totalHorasExtensao = $certificados->where('id_tipo_atividade', 10)->sum(function ($certificado) use ($atividadeCounts) {
            return $atividadeCounts[$certificado->id_tipo_atividade]['horas_acc_sum'];
        });*/
        $grupoA = [7, 9, 15, 80, 82, 83, 13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 28, 29, 32, 33, 34, 35, 36, 37, 39, 40, 41, 43, 44, 45, 50, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74];//Grupo de atividades com bastante horas de carga 
        $grupoB = [5, 6, 52, 64, 48, 8, 51, 12, 22, 30, 76, 78, 81]; // Valores de atividades especiais com carga horária  menores
       
    
        $maxHorasACC = $curso->carga_horaria_ACC;
        $maxHorasExtensao = $curso->carga_horaria_Extensao;

        $necessarioACC = $totalHorasACC >= $maxHorasACC
            ? 'Alcançou o máximo de horas ACC permitidas para integralizar, Parabéns, Veja o relatório para mais detalhes'
            : 'Faltam ' . ($maxHorasACC - $totalHorasACC) . ' horas para alcançar o máximo permitido de horas ACC';

        $necessarioExtensao = $totalHorasExtensao >= $maxHorasExtensao
            ? 'Alcançou o máximo de horas de Extensão permitidas para integralizar'
            : 'Faltam ' . ($maxHorasExtensao - $totalHorasExtensao) . ' horas para alcançar o máximo permitido de horas de Extensão';
            $pdf = Pdf::loadView('pdf.reporte', compact(
                'certificados',
                'totalCertificados',
                'atividadeCounts',
                'curso',
                'discente',
                'totalHorasACC',
                'totalHorasExtensao',
                'necessarioACC',
                'necessarioExtensao',
                'maxHorasACC',
                'maxHorasExtensao',
                'grupoA', // Pass the grupoA array to the view
                'grupoB'  // Pass the grupoB array to the view
            ))
        ->setPaper('a4', 'landscape');

        return $pdf->download('reportes.pdf');
    }
    

    public function generatePdfuser($id)
    {
        $user = User::find($id); // Encontrar o usuário pelo ID fornecido
        $curso = AdCursos::find($user->id_curso);
    
        if (!$curso) {
            return Redirect::route('error');
        }
    
        $horaExtensão = $curso->carga_horaria_Extensao;
    
        $query = NgCertificados::with(['ngAtividade', 'user']);
    
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
    
        // Contar o número total de certificados
        $totalCertificados = $certificados->count();
    
        // Adicionar o discente, utilizando o nome do usuário
        $discente = $user;
    
        // Contar a ocorrência de cada tipo de atividade, somar horas ACC e calcular percentual máximo permitido
        $atividadeCounts = $certificados->groupBy('id_tipo_atividade')
            ->map(function ($rows, $id_tipo_atividade) use ($curso) {
                $count = $rows->count();
                $horas_acc_sum = $rows->sum('horas_ACC');
                $atividade = NgAtividades::find($id_tipo_atividade);
                $percentual_maximo = $atividade ? $atividade->percentual_maximo : 0;
    
                if ($id_tipo_atividade === 10) {
                    $maxHorasPermitidas = ($percentual_maximo * $curso->carga_horaria_Extensao) / 100;
                } else {
                    $maxHorasPermitidas = ($percentual_maximo * $curso->carga_horaria_ACC) / 100;
                }
    
                $horasRestantes = $maxHorasPermitidas - $horas_acc_sum;
                $horasExcedentes = $horas_acc_sum > $maxHorasPermitidas ? $horas_acc_sum - $maxHorasPermitidas : 0;
                $horasValidas = $horas_acc_sum > $maxHorasPermitidas ? $maxHorasPermitidas : $horas_acc_sum;
    
                $comparacao = $horas_acc_sum > $maxHorasPermitidas
                    ? "Alcançou o máximo de horas permitidas para integralizar. Horas não consideradas: {$horasExcedentes}"
                    : "Faltam {$horasRestantes} horas para alcançar o máximo permitido :)";
    
                return [
                    'count' => $count,
                    'horas_acc_sum' => $horasValidas,
                    'horasExcedentes' => $horasExcedentes,
                    'percentual_maximo' => $percentual_maximo,
                    'maxHorasPermitidas' => $maxHorasPermitidas,
                    'comparacao' => $comparacao,
                    'atividade' => $atividade
                ];
            })
            ->sortDesc();
    
        // Calcular a soma total das horas ACC e das horas de extensão
        $totalHorasACC = $certificados->where('id_tipo_atividade', '!=', 10)->sum('horas_ACC');
    
        $totalHorasExtensao = $certificados->where('id_tipo_atividade', 10)->sum(function ($certificado) use ($atividadeCounts) {
            return $atividadeCounts[$certificado->id_tipo_atividade]['horas_acc_sum'];
        });
    
        // Comparar a soma total das horas ACC com as horas máximas permitidas
        $maxHorasACC = $curso->carga_horaria_ACC;
        $maxHorasExtensao = $curso->carga_horaria_Extensao;
    
        $necessarioACC = $totalHorasACC >= $maxHorasACC
            ? 'Alcançou o máximo de horas ACC permitidas para integralizar'
            : 'Faltam ' . ($maxHorasACC - $totalHorasACC) . ' horas para alcançar o máximo permitido de horas ACC';
    
        $necessarioExtensao = $totalHorasExtensao >= $maxHorasExtensao
            ? 'Alcançou o máximo de horas de Extensão permitidas para integralizar'
            : 'Faltam ' . ($maxHorasExtensao - $totalHorasExtensao) . ' horas para alcançar o máximo permitido de horas de Extensão';
    
        $pdf = Pdf::loadView('pdf.reporte', compact(
            'certificados',
            'totalCertificados',
            'atividadeCounts',
            'curso',
            'discente', // Passando o nome do discente para a view
            'totalHorasACC',
            'totalHorasExtensao',
            'necessarioACC',
            'necessarioExtensao'
        ))
        ->setPaper('a4', 'landscape');
    
        return $pdf->download('reportes.pdf');
    }
    

   

private function calcularComparacao($horas_acc_sum, $percentual_maximo, $carga_horaria_ACC)
{
    $maximo_permitido = $percentual_maximo * $carga_horaria_ACC / 100;
    if ($horas_acc_sum >= $maximo_permitido) {
        return "Alcançou o máximo de horas permitidas para integralizar.";
    } else {
        return "Pode integralizar mais " . ($maximo_permitido - $horas_acc_sum) . " horas.";
    }
}
}