<?php

namespace App\Livewire\Almacen\Movements;

use App\Models\Movement;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditMovement extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Movement $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tipo')
                    ->required(),
                Forms\Components\TextInput::make('order_id')
                    ->numeric()
                    ->default('NULL'),
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
        return view('livewire.almacen.movements.edit-movement');
    }
}
