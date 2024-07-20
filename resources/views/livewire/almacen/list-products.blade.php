<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-filament::button href="{{ route('create.product') }}" tag="a" icon="heroicon-o-squares-plus"
            class="bg-indigo-800 hover:bg-indigo-700">Registrar
            Material</x-filament::button>
    </div>
    {{ $this->table }}
</x-bree.container>
