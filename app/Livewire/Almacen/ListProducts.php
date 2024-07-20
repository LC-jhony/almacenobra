<?php

namespace App\Livewire\Almacen;

use App\Filament\Imports\ProductImporter;
use App\Models\Category;
use App\Models\Product;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ListProducts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    #[Layout("layouts.admin")]
    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
            ->striped()
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('COD.')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('DESCRIPCION')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pu')
                    ->label('P.U.')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('um')
                    ->label('U.M.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('oc')
                    ->label('O/C')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Saldo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

                // ImportAction::make()
                //     ->label('Importar materiales')
                //     ->icon('heroicon-o-arrow-up-tray')
                //     ->color('success')
                //     ->importer(ProductImporter::class)
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Categoria')
                    ->options(Category::query()->pluck('name', 'id'))
                    ->native(false)
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
