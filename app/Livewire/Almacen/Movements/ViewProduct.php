<?php

namespace App\Livewire\Almacen\Movements;

use App\Models\Product;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class ViewProduct extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;
    public $product;

    public function productInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->product)
            ->schema([
                TextEntry::make('name'),

            ]);
    }
    public function render()
    {
        return view('livewire.almacen.movements.view-product');
    }
}
