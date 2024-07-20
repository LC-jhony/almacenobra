<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament::button type="submit" class="bg-indigo-800 hover:bg-indigo-700">
                Registar categoria
            </x-filament::button>
            <x-filament::button color="danger" href="{{ route('list.category') }}"
                tag="a">Cancelar</x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-bree.container>
