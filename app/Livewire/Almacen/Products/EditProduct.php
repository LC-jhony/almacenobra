<?php

namespace App\Livewire\Almacen\Products;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditProduct extends Component implements HasForms
{
    use InteractsWithForms;
    #[Layout("layouts.app")]
    public ?array $data = [];

    public Product $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pu')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('um')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('oc')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.almacen.products.edit-product');
    }
}
