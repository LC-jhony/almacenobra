<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-filament::button href="{{ route('category.create') }}" tag="a" class="bg-indigo-800 hover:bg-indigo-700">
            Registar Categoria
        </x-filament::button>
    </div>
    {{ $this->table }}
</x-bree.container>
