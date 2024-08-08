<?php

namespace App\Filament\Resources\ProgressaoResource\Pages;

use App\Filament\Resources\ProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\Professor;

class EditProgressao extends EditRecord
{
    protected static string $resource = ProgressaoResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        
        $currentUser = Auth::user();

        //$professor = Auth::user()->id_professor;

        $professor = Professor::where('user_id', $currentUser->id)->first();
        $professorId = $professor ? $professor->id : null;

        if ($professorId) {
            $data['siape'] = $professor->siape;
            $data['lotacao'] = $professor->lotacao;
            $data['admissao'] = $professor->admissao;
           // $data['classe'] = $professor->classe;
            //$data['regime'] = $professor->regime;
           // $data['nivel'] = $professor->nivel;
           // $data['data_ultima_progressao'] = $professor->data_ultima_progressao;
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $professor = Auth::user()->professor;

        if ($professor) {
            $professor->update([
                'siape' => $data['siape'],
                'lotacao' => $data['lotacao'],
                'admissao' => $data['admissao'],
            //    'classe' => $data['classe'],
             //   'regime' => $data['regime'],
             //   'nivel' => $data['nivel'],
             //   'data_ultima_progressao' => $data['data_ultima_progressao'],
            ]);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}