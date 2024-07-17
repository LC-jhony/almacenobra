<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-filament::button href="{{ route('create.product') }}" tag="a" icon="heroicon-o-squares-plus">Registrar
            Material</x-filament::button>
    </div>
    {{ $this->table }}
</x-bree.container>
