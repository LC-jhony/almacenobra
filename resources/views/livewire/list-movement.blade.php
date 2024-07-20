<x-bree.container>
    <div class="flex justify-end mb-4 gap-5">
        <x-filament::button href="{{ route('create.output.movement') }}" tag="a" color="warning"
            icon="heroicon-o-arrow-up-tray">
            Registar Salida
        </x-filament::button>
        <x-filament::button href="{{ route('create.input.movement') }}" tag="a" icon="heroicon-o-arrow-down-tray" class="bg-indigo-800 hover:bg-indigo-700">
            Registar Entrada
        </x-filament::button>

    </div>
    {{ $this->table }}
</x-bree.container>
