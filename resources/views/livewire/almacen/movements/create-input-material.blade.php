<x-bree.container>
    <h1>entrada</h1>
    <form wire:submit="create">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament::button type="submit" class="bg-indigo-800 hover:bg-indigo-700">
                Registrar movimiento
            </x-filament::button>
            <x-filament::button href="{{ route('list.movement') }}" tag="a" color="danger">
                Cancelar
            </x-filament::button>
        </div>
    </form>
    <x-filament-actions::modals />
</x-bree.container>
