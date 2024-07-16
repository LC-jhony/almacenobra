<?php

namespace App\Livewire\Almacen\Products;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateProduct extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Materiales")
                    ->description("Registra los materiales")
                    ->schema([
                        Card::make("")
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan(2),
                            ])->columns(3),
                        Card::make("")
                            ->schema([
                                Forms\Components\TextInput::make('pu')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('um')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('oc')
                                    ->required()
                                    ->numeric(),
                            ])->columns(3),
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->native(false)

                    ])->columns(2)
            ])
            ->statePath('data')
            ->model(Product::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Product::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.almacen.products.create-product');
    }
}
