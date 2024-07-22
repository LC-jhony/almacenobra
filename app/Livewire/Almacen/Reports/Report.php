<?php

namespace App\Livewire\Almacen\Reports;

use App\Enum\MonthType;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMovement;
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
    #[Layout("layouts.admin")]
    public $categoriesWithProducts;
    public $year;
    public $month;
    public $daysInMonth;

    public $monthName;


    public function mount(): void
    {
        $this->categoriesWithProducts = Category::with("products")->get();
        $this->month = now()->format("m");
        $this->year = $year ?? now()->year;
        $this->daysInMonth =
            Carbon::createFromDate($this->year, $this->month, 1)->daysInMonth;

        $this->setMonthName();
        $this->loadData();
    }
    public function loadData()
    {
        $this->categoriesWithProducts = Category::with(['products.movementproduct' => function ($query) {
            $query->whereYear('created_at', $this->year)
                ->whereMonth('created_at', $this->month);
        }])->get();
    }
    public function updatedMonth()
    {
        $this->setMonthName();
    }
    protected function setMonthName()
    {
        $this->monthName =
            Carbon::createFromFormat('m', $this->month)->locale('es')->translatedFormat('F');
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Filtro por meses")
                    ->schema([
                        Forms\Components\Select::make('month')
                            ->label('Mese')
                            ->options(MonthType::class)
                            ->searchable()
                            ->native(false)
                            ->reactive()
                    ])
            ]);
    }

    public function render()
    {
        $daysInMonth =
            Carbon::createFromFormat('m', $this->month)->daysInMonth;

        return view('livewire.almacen.reports.report', [
            'products' => Product::paginate(10),
            'daysInMonth' => $daysInMonth,
            'monthName' => $this->monthName,

        ]);
    }
}
