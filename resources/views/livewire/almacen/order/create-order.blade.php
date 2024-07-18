<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament::button type="submit" class="mt-4">
                Registar orden
            </x-filament::button>
            <x-filament::button color="danger" href="{{ route('list.order') }}"
                tag="a">Cancelar</x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />
</x-bree.container>
