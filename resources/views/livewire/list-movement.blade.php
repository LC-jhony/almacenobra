<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-filament::button href="{{ route('create.movement') }}" tag="a">
            Registar movimiento
        </x-filament::button>
    </div>
    {{ $this->table }}
</x-bree.container>
