<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Registar categoria
        </x-filament::button>
        <x-filament::button color="danger" href="{{ route('list.category') }}" tag="a">Cancelar</x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-bree.container>
