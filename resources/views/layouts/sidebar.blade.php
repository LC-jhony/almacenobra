<nav :class="{ 'block': open, 'hidden': !open }" class="flex-grow px-4 pb-4 mt-6 md:block md:pb-0 md:overflow-y-auto">
    <x-bree.nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
        <x-heroicon-o-home class="w-5 h-5" />
        {{ __('Dashboard') }}
    </x-bree.nav-link>
    <div class="flex items-center gap-x-3 mt-7 px-2 py-2 cursor-pointer ">
        <span class="fi-sidebar-group-label flex-1 text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
            Shop
        </span>
    </div>


    <x-bree.nav-link :href="route('list.category')" :active="request()->routeIs('list.category')" wire:navigate>
        <x-heroicon-o-tag class="w-5 h-5" />
        {{ __('Categoria') }}
    </x-bree.nav-link>
    <x-bree.nav-link :href="route('list.order')" :active="request()->routeIs('list.order')" wire:navigate>
        <x-heroicon-o-document-duplicate class="w-5 h-5" />
        {{ __('Ordenes') }}
    </x-bree.nav-link>
    <x-bree.nav-link :href="route('list.products')" :active="request()->routeIs('list.products')" wire:navigate>
        <x-heroicon-o-cube class="w-5 h-5" />
        {{ __('Productos') }}
    </x-bree.nav-link>
    <x-bree.nav-link :href="route('list.movement')" :active="request()->routeIs('list.movement')" wire:navigate>
        <x-heroicon-o-rocket-launch class="w-5 h-5" />
        {{ __('Movimiento') }}
    </x-bree.nav-link>
    <x-bree.nav-link :href="route('report')" :active="request()->routeIs('report')" wire:navigate>
        <x-heroicon-o-arrow-trending-up class="w-5 h-5" />
        {{ __('Reporte') }}
    </x-bree.nav-link>

</nav>
