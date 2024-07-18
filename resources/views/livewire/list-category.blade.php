<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-filament::button href="{{ route('category.create') }}" tag="a">
            Registar Categoria
        </x-filament::button>
    </div>
    {{ $this->table }}
</x-bree.container>
