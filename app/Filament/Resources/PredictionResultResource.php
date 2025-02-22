<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PredictionResultResource\Pages;
use App\Filament\Resources\PredictionResultResource\RelationManagers;
use App\Models\PredictionResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PredictionResultResource extends Resource
{
    protected static ?string $model = PredictionResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('prediction'),
                Forms\Components\Textarea::make('recommandations')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('interprétation')
                    ->required(),
                Forms\Components\Textarea::make('classe')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('model_type'),
                Forms\Components\TextInput::make('medical_data_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prediction')
                    ->searchable(),
                Tables\Columns\TextColumn::make('interprétation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('model_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('medical_data_id')
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPredictionResults::route('/'),
            'create' => Pages\CreatePredictionResult::route('/create'),
            'edit' => Pages\EditPredictionResult::route('/{record}/edit'),
        ];
    }
}
