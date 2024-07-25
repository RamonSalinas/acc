<?php

namespace App\Filament\Resources\ProgressaoResource\Pages;

use App\Filament\Resources\ProgressaoResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Progressao;

class CreateProgressao extends CreateRecord
{
    protected static string $resource = ProgressaoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Auth::user();

        // Atualiza ou cria a entrada professor
        if ($user->professor) {
            $user->professor->update([
                'siape' => $data['siape'],
                'lotacao' => $data['lotacao'],
                'admissao' => $data['admissao'],
                'classe' => $data['classe'],
            //    'regime' => $data['regime'],
               'nivel' => $data['nivel'],
                'data_ultima_progressao' => $data['data_ultima_progressao'],
                'intersticio_data_inicial' => $data['intersticio_data_inicial'],
                'intersticio_data_final' => $data['intersticio_data_final'],
            ]);
        } else {
           //vamos a ver que hago kkk
        }// Adiciona o ID do professor aos dados
        $data['professor_id'] = $user->professor->id;




        function gerarNomeProgressaoPadrao()
{
    // Obter o último ID registrado na tabela de progressões
    $ultimoId = Progressao::max('id') + 1;

    // Obter a data atual
    $dataAtual = Carbon::now();

    // Formatar a data como dia, mês e ano
    $dataFormatada = $dataAtual->format('d-m-Y');

    // Gerar o nome padrão
    return "Progressao-{$ultimoId}-{$dataFormatada}";
}


        // Garante que o campo nome_progressao esteja preenchido
        if (empty($data['nome_progressao'])) {
            $data['nome_progressao'] = gerarNomeProgressaoPadrao();
        }

        return $data;
    }
}