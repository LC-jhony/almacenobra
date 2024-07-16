<?php

namespace App\Livewire\Almacen;

use App\Filament\Imports\ProductImporter;
use App\Models\Product;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    #[Layout("layouts.app")]
    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pu')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('um')
                    ->searchable(),
                Tables\Columns\TextColumn::make('oc')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([

                ImportAction::make()
                    ->label('Importar materiales')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('success')
                    ->importer(ProductImporter::class)
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }


    public function render(): View
    {
        return view('livewire.almacen.list-products');
    }
}
