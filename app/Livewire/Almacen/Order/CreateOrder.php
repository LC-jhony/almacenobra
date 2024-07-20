<?php

namespace App\Livewire\Almacen\Order;

use App\Models\OrderParchuse;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateOrder extends Component implements HasForms
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
                Section::make("Orden Compra")
                    ->description("Registre ordenes de compra")
                    ->schema([
                        Forms\Components\TextInput::make("number")
                            ->label("Nombre")
                            ->required(),
                    ])
            ])
            ->statePath('data')
            ->model(OrderParchuse::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = OrderParchuse::create($data);

        $this->form->model($record)->saveRelationships();

        $this->reset();

        $this->getSavedNotification()->send();
    }
    protected function getSavedNotification(): Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Orden de compra'))
            ->body(__('Orden compra registrado correctamente'))
            ->success();
    }

    public function render(): View
    {
        return view('livewire.almacen.order.create-order');
    }
}
