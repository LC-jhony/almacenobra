<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Registar producto
        </x-filament::button>
        <x-filament::button color="danger">Cancelar</x-filament::button>
    </form>

    <x-filament-actions::modals />
</x-bree.container>
