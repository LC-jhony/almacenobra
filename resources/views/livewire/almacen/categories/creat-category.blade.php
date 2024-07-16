<x-bree.container>
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Registar categoria
        </x-filament::button>
        <x-filament::button color="danger">Cancelar</x-filament::button>
    </form>
    <div class="bg-indigo-700 p-4 mt-6">
        <h2 class="text-3xl text-white font-bold mb-12">Chronology</h2>
        @foreach ($categories as $category)
            <div class="flex flex-col grid-cols-9 p-2 mx-auto md:grid">
                <div class="flex md:contents flex-row-reverse">
                    <div
                        class="relative p-4 my-6 text-gray-800 bg-white rounded-xl col-start-1 col-end-5 mr-auto md:mr-0 md:ml-auto">
                        <h3 class="text-lg font-semibold lg:text-xl">{{ $category->id }}</h3>
                        <p class="mt-2 leading-6">{{ $category->name }}</p>
                        <span
                            class="absolute text-sm text-indigo-100/75 -top-5 left-2 whitespace-nowrap">{{ $category->created_at }}</span>
                    </div>
                    <div class="relative col-start-5 col-end-6 mr-7 md:mx-auto">
                        <div class="flex items-center justify-center w-6 h-full">
                            <div
                                class="w-1 h-full bg-indigo-300 rounded-t-full bg-gradient-to-b from-indigo-400 to-indigo-300">
                            </div>
                        </div>
                        <div class="absolute w-6 h-6 -mt-3 bg-white border-4 border-indigo-400 rounded-full top-1/2">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <x-filament-actions::modals />
</x-bree.container>
