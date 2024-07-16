<?php

namespace App\Livewire\Almacen\Reports;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Report extends Component
{

    #[Layout("layouts.app")]
    public $categoriesWithProducts ;
    public function mount(): void
    {
        $this->categoriesWithProducts = Category::with("products")->get();
    }
    public function render()
    {
        return view('livewire.almacen.reports.report');
    }
}
