<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenandatanganResource\Pages;
use App\Filament\Resources\PenandatanganResource\RelationManagers;
use App\Models\Penandatangan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenandatanganResource extends Resource
{
    protected static ?string $model = Penandatangan::class;

    protected static ?string $label = 'Data Penandatangan';

    protected static ?string $navigationGroup = 'Referensi';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $count = static::getModel()::count();

        return match (true) {
            $count === 0 => 'danger',
            $count <= 100 => 'info',
            default => 'success',
        };
    }

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Pendandatangan')
                    ->placeholder('Masukkan Nama Penandatangan')
                    ->inlineLabel()
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Penandatangan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePenandatangans::route('/'),
        ];
    }
}
