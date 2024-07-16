<?php

namespace App\Livewire\Almacen\Categories;

use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CreateCategory extends Component implements HasForms
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
                Section::make("Categoria")
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
            ])
            ->statePath('data')
            ->model(Category::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Category::create($data);

        $this->form->model($record)->saveRelationships();
        
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
        return view('livewire.amacen.categories.creat-category', [
            'categories' => Category::all(),
        ]);
    }
}
