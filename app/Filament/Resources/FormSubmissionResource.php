<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormSubmissionResource\Pages;
use App\Models\FormSubmission;
use App\Models\Form;
use Filament\Forms;
use Filament\Forms\Form as FilamentForm;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\Section;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Hasil Pengisian';
    protected static ?string $navigationGroup = 'Form Builder';
    
    protected static ?int $navigationSort = 2;

    public static function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
                // Read-only form for viewing submissions
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                
                TextColumn::make('form.title')
                    ->label('Formulir')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('submitted_by_name')
                    ->label('Nama')
                    ->searchable()
                    ->placeholder('Anonim'),
                
                TextColumn::make('submitted_by_email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('Tidak tersedia'),
                
                TextColumn::make('submitted_by_phone')
                    ->label('Telepon')
                    ->placeholder('Tidak tersedia'),
                
                TextColumn::make('ip_address')
                    ->label('Alamat IP'),
                
                TextColumn::make('created_at')
                    ->label('Diisi Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('form_id')
                    ->label('Formulir')
                    ->options(Form::pluck('title', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->modalHeading(fn (FormSubmission $record) => "Submission for: {$record->form->title}")
                    ->infolist([
                        Section::make('Form Information')
                            ->schema([
                                TextEntry::make('form.title')
                                    ->label('Form Title'),
                                TextEntry::make('form.description')
                                    ->label('Description')
                                    ->placeholder('No description'),
                            ])
                            ->columns(2),
                        
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
                        
                        Section::make('Submission Data')
                            ->schema([
                                KeyValueEntry::make('processed_data')
                                    ->label('')
                                    ->keyLabel('Field')
                                    ->valueLabel('Response')
                                    ->getStateUsing(function (FormSubmission $record) {
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormSubmissions::route('/'),
        ];
    }
}
