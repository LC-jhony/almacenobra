<?php

namespace App\Livewire\Almacen\Movements;

use App\Enum\MovementType;
use App\Models\Movement;
use App\Models\OrderParchuse;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateInputMaterial extends Component implements HasForms
{
    use InteractsWithForms;

    #[Layout("layouts.admin")]

    public ?array $data = [];
    public $orderProducts = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Movimiento")
                    ->description("registre movimiento de materiales")
                    ->schema([
                        Forms\Components\Select::make('tipo')
                            ->label('Tipo')
                            ->options(MovementType::class)
                            ->required()
                            ->native(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state) {
                                $this->handleTipoChange($state);
                            }),
                        Forms\Components\Select::make('order_id')
                            ->label('Orden de compra')
                            ->options(OrderParchuse::pluck('number', 'id'))
                            ->nullable()
                            ->native(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state) {
                                $this->handleOrderChange($state);
                            }),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Created at')
                        // Forms\Components\DateTimePicker::make('created_at')

                        //     ->default(now())
                        //     ->native(false),
                    ])->columns(3),
                Forms\Components\Repeater::make('movementproduct')
                    ->label('Materiales')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Material')
                            ->searchable()
                            ->options(function () {
                                return collect($this->orderProducts)->pluck('name', 'id');
                            })
                            ->native(false)
                            ->afterStateUpdated(
                                function ($state, $get, $set) {
                                    $this->updateQuantity(
                                        $state,
                                        $get,
                                        $set
                                    );
                                }
                            ),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad a Mover')
                            ->required()
                            ->dehydrated()
                            ->live(),


                    ])->columns(3)
            ])
            ->statePath('data')
            ->model(Movement::class);
    }
    public function handleTipoChange($state): void
    {
        if ($state === 'entrada') {
            $this->orderProducts = [];
        }
    }


    public function handleOrderChange($state): void
    {
        if ($this->data['tipo'] === 'entrada' && $state) {
            $this->orderProducts = OrderParchuse::find($state)->products->toArray();
        } else {
            $this->orderProducts = [];
        }
    }
    public function updateQuantity($productId, $get, $set): void
    {
        $product = Product::find($productId);
        if ($product) {
            $set('quantity', $product->quantity);
        } else {
            $set('quantity', 0);
        }
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Movement::create($data);

        $this->form->model($record)->saveRelationships();
        foreach ($record['movementproduct'] as $item) {
            $product = Product::find($item['product_id']);
            $product->quantity;
            $product->save();
        }
        $this->reset();

        $this->getSavedNotification()->send();
    }
    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Movimiento'))
            ->body(__('Movimiento registrado correctamente'))
            ->success();
    }
    public function render(): View
    {
        return view('livewire.almacen.movements.create-input-material');
    }
}
