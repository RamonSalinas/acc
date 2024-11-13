<?php

namespace App\Filament\Resources\ProfessorResource\Pages;

use App\Filament\Resources\ProfessorResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use App\Models\Professor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CreateProfessor extends CreateRecord
{
        protected static string $resource = ProfessorResource::class;
    
        protected function mutateFormDataBeforeCreate(array $data): array
        {
            // Retorna os dados (obrigatório)
            return $data;
        }
    
        protected function getRedirectUrl(): string
        {
            // Garante que o redirecionamento seja para a listagem de professores
            return ProfessorResource::getUrl('index');
        }
    
        protected function afterCreate(): void
        {
            $data = $this->record->toArray();
            //consegui Criar o professor Assim que for criado o Orientador, para puder criar o AVALIADOR PELA COORDENAÇÃO.
            Professor::create([
                'email' => $data['email'],
                'user_id'=> $data['id_professor'],
                'siape' => '7855647002',
                'lotacao' => '',
                'admissao' => Carbon::now(),
                'classe' => 'A',
                'regime' => 'DE',
                'nivel' => '1',
                'data_ultima_progressao' => Carbon::now(),
                'intersticio_data_inicial' => Carbon::now(),
                'intersticio_data_final' => Carbon::now()->addYear(),
            ]);


       }
    
    }