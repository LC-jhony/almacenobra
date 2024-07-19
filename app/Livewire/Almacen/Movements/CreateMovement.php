<?php

namespace App\Livewire\Almacen\Movements;

use App\Enum\MovementType;
use App\Models\Movement;
use App\Models\OrderParchuse;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Laravel\SerializableClosure\Serializers\Native;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateMovement extends Component implements HasForms
{
    use InteractsWithForms;
    #[Layout("layouts.app")]

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Movimiento")
                    ->description("registre movimiento de materiales")
                    ->schema([
                        Forms\Components\Select::make('tipo')
                            ->label('tipo')
                            ->options(MovementType::class)
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('order_id')
                            ->label('Orden de compra')
                            ->options(OrderParchuse::pluck('number', 'id'))
                            ->nullable()
                            ->native(false),
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
                            ->options(Product::query()->pluck('name', 'id'))
                            ->native(false)
                            ->columnSpan(2),
                        // Forms\Components\TextInput::make('movement_id'),
                        Forms\Components\TextInput::make('quantity')
                            ->label('Cantidad')

                    ])->columns(3)
            ])
            ->statePath('data')
            ->model(Movement::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Movement::create($data);

        $this->form->model($record)->saveRelationships();

        foreach ($record['movementproduct'] as $item) {
            $product = Product::find($item['product_id']);
            $product->quantity -= $item['quantity'];
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
        return view('livewire.almacen.movements.create-movement');
    }
}
