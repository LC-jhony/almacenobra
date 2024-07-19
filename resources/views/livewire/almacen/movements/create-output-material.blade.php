<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament::button type="submit">
                Registrar movimiento
            </x-filament::button>
            <x-filament::button href="{{ route('list.movement') }}" tag="a" color="danger">
                Cancelar
            </x-filament::button>
        </div>
    </form>
    <x-filament-actions::modals />
</x-bree.container>
