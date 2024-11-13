{{-- resources/views/filament/widgets/nome-curso-widget-stats.blade.php --}}
<x-filament::widget>
    <x-filament::card>
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="space-y-2">
                <div class="flex items-center">
                    <div class="w-1/3 font-semibold text-gray-600">{{ __('Nome do Curso:') }}</div>
                    <div class="w-2/3 text-gray-800">{{ $nomeCurso }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/3 font-semibold text-gray-600">{{ __('Carga Horária do Curso:') }}</div>
                    <div class="w-2/3 text-gray-800">{{ $cargaHorariaCurso }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/3 font-semibold text-gray-600">{{ __('Carga Horária ACC:') }}</div>
                    <div class="w-2/3 text-gray-800">{{ $cargaHorariaACC }}</div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/3 font-semibold text-gray-600">{{ __('Carga Horária Extensão:') }}</div>
                    <div class="w-2/3 text-gray-800">{{ $cargaHorariaExtensao }}</div>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
