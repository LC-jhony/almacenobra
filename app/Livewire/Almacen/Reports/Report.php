<?php

namespace App\Livewire\Almacen\Reports;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Report extends Component implements HasForms
{
    use InteractsWithForms;
    use WithPagination;
    #[Layout("layouts.app")]
    public $categoriesWithProducts;
    public $month;
    public $monthName;
    public function mount(): void
    {
        $this->categoriesWithProducts = Category::with("products")->get();
        $this->month = now()->format("m");
        $this->setMonthName();
    }
    public function updatedMonth()
    {
        $this->setMonthName();
    }
    protected function setMonthName()
    {
        $this->monthName = Carbon::createFromFormat('m', $this->month)->format('F');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Filtro por meses")
                    ->schema([
                        Forms\Components\Select::make('month')
                            ->label('Mese')
                            ->options([
                                '01' => 'January',
                                '02' => 'February',
                                '03' => 'March',
                                '04' => 'April',
                                '05' => 'May',
                                '06' => 'June',
                                '07' => 'July',
                                '08' => 'August',
                                '09' => 'September',
                                '10' => 'October',
                                '11' => 'November',
                                '12' => 'December',
                            ])
                            ->searchable()
                            ->native(false)
                            ->reactive()
                    ])
            ]);
    }
    public function render()
    {
        $daysInMonth = Carbon::createFromFormat('m', $this->month)->daysInMonth;

        return view('livewire.almacen.reports.report', [
            'products' => Product::paginate(10),
            'daysInMonth' => $daysInMonth,
            'monthName' => $this->monthName,
        ]);
    }
}
