<?php

namespace App\Livewire\Almacen\Products;

use App\Models\OrderParchuse;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateProduct extends Component implements HasForms
{
    use InteractsWithForms;
    #[Layout("layouts.admin")]
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
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric(),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->native(false),

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
                                Forms\Components\Select::make('order_id')
                                    ->options(OrderParchuse::query()->pluck('number', 'id')->toArray())
                                    ->required()
                                    ->native(false),

                            ])->columns(3),


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

        $this->reset();

        $this->getSavedNotification()->send();
    }
    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Material'))
            ->body(__('Material registrado correctamente'))
            ->success();
    }

    public function render(): View
    {
        return view('livewire.almacen.products.create-product');
    }
}
