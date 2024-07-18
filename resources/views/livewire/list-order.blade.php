<x-bree.container>
    <div class="flex justify-end mb-4">
        <x-bree.button href="{{ route('create.order') }}">
            Registar orden
        </x-bree.button>
    </div>
    {{ $this->table }}
</x-bree.container>
