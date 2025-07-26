<?php

namespace App\Filament\Resources\FormResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;

class SubmissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'submissions';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                TextColumn::make('submitted_by_name')
                    ->label('Name')
                    ->searchable()
                    ->placeholder('Anonymous'),
                
                TextColumn::make('submitted_by_email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('Not provided'),
                
                TextColumn::make('submitted_by_phone')
                    ->label('Phone')
                    ->placeholder('Not provided'),
                
                TextColumn::make('ip_address')
                    ->label('IP Address'),
                
                TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View Data')
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Submission Data')
                    ->infolist([
                        Section::make('Submitter Information')
                            ->schema([
                                TextEntry::make('submitted_by_name')
                                    ->label('Name')
                                    ->placeholder('Anonymous'),
                                TextEntry::make('submitted_by_email')
                                    ->label('Email')
                                    ->placeholder('Not provided'),
                                TextEntry::make('submitted_by_phone')
                                    ->label('Phone')
                                    ->placeholder('Not provided'),
                                TextEntry::make('ip_address')
                                    ->label('IP Address'),
                                TextEntry::make('created_at')
                                    ->label('Submitted At')
                                    ->dateTime(),
                            ])
                            ->columns(2),
                        
                        Section::make('Form Data')
                            ->schema([
                                KeyValueEntry::make('processed_data')
                                    ->label('')
                                    ->keyLabel('Field')
                                    ->valueLabel('Response')
                                    ->getStateUsing(function ($record) {
                                        $processedData = [];
                                        foreach ($record->data as $key => $value) {
                                            if (is_array($value)) {
                                                $processedData[$key] = empty($value) ? 'No selection' : implode(', ', $value);
                                            } else {
                                                $processedData[$key] = $value ?: 'Not provided';
                                            }
                                        }
                                        return $processedData;
                                    }),
                            ]),
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
