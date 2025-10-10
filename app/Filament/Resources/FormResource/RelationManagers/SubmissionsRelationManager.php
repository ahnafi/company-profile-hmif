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
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormSubmissionsExcelExport;
use App\Filament\Exports\FormSubmissionExporter;

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
                Action::make('export')
                    ->label('Export to Excel')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($livewire) {
                        $formId = $livewire->ownerRecord->id;
                        $formTitle = $livewire->ownerRecord->title;
                        
                        $fileName = 'form-submissions-' . \Str::slug($formTitle) . '-' . now()->format('Y-m-d-His') . '.xlsx';
                        
                        return Excel::download(
                            new FormSubmissionsExcelExport($formId),
                            $fileName
                        );
                    }),
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
                                TextEntry::make('formatted_data')
                                    ->label('')
                                    ->html()
                                    ->getStateUsing(function ($record) {
                                        $html = '<div class="space-y-3">';
                                        foreach ($record->data as $key => $value) {
                                            $html .= '<div class="flex flex-col space-y-1">';
                                            $html .= '<dt class="font-medium text-sm text-gray-500">' . e($key) . '</dt>';
                                            
                                            if (is_array($value)) {
                                                $html .= '<dd class="text-sm text-gray-900">' . (empty($value) ? 'No selection' : e(implode(', ', $value))) . '</dd>';
                                            } elseif (is_string($value) && str_starts_with($value, 'form-submissions/')) {
                                                // Convert file path to clickable link
                                                $url = asset('storage/' . $value);
                                                $filename = basename($value);
                                                $html .= '<dd class="text-sm"><a href="' . $url . '" target="_blank" class="text-blue-600 hover:text-blue-800 underline flex items-center gap-1">';
                                                $html .= '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>';
                                                $html .= e($filename) . '</a></dd>';
                                            } else {
                                                $html .= '<dd class="text-sm text-gray-900">' . e($value ?: 'Not provided') . '</dd>';
                                            }
                                            
                                            $html .= '</div>';
                                        }
                                        $html .= '</div>';
                                        return $html;
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
