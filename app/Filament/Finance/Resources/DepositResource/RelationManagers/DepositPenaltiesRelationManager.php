<?php

namespace App\Filament\Finance\Resources\DepositResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepositPenaltiesRelationManager extends RelationManager
{
    protected static string $relationship = 'depositPenalties';

    protected static ?string $title = 'Denda Deposit';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\Select::make('detail')
                    ->label('Jenis Denda')
                    ->options([
                        'plenary_meeting' => 'Tidak mengikuti rapat pleno / Terlambat mengikuti rapat pleno',
                        'jacket_day' => 'Tidak menggunakan jahim ketika jahim day',
                        'graduation_ceremony' => 'Tidak mengikuti wisuda offline',
                        'secretariat_maintenance' => 'Tidak mengikuti piket pesek',
                        'work_program' => 'Tidak bertanggung jawab dalam menjalankan proker',
                        'other' => 'Lainnya'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah Denda')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('detail')
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('detail')
                    ->label('Jenis Denda')
                    ->formatStateUsing(fn($record) => $record->detail_description)
                    ->wrap(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah Denda')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('detail')
                    ->label('Jenis Denda')
                    ->options([
                        'plenary_meeting' => 'Rapat Pleno',
                        'jacket_day' => 'Jahim Day',
                        'graduation_ceremony' => 'Wisuda',
                        'secretariat_maintenance' => 'Piket Pesek',
                        'work_program' => 'Proker',
                        'other' => 'Lainnya'
                    ]),
                Tables\Filters\Filter::make('date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Denda'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->emptyStateHeading('Belum ada denda')
            ->emptyStateDescription('Belum ada denda yang terdaftar untuk deposit ini.')
            ->emptyStateIcon('heroicon-o-exclamation-triangle');
    }
}
