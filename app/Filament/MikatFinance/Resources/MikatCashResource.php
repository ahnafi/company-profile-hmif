<?php

namespace App\Filament\MikatFinance\Resources;

use App\Filament\MikatFinance\Resources\MikatCashResource\Pages;
use App\Filament\MikatFinance\Resources\MikatCashResource\RelationManagers;
use App\Models\MikatCash;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MikatCashResource extends Resource
{
    protected static ?string $model = MikatCash::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('administrator_id')
                    ->label('Administrator')
                    ->relationship('administrator', 'name', fn (Builder $query) => 
                        $query->whereHas('division', fn (Builder $query) => 
                            $query->where('slug', 'minat-dan-bakat')
                        )
                    )
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\TextInput::make('work_program')
                    ->label('Program Kerja')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Jenis Transaksi')
                    ->options([
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                        'external_expense' => 'Pengeluaran Eksternal'
                    ])
                    ->required(),
                Forms\Components\TextInput::make('source_fund')
                    ->label('Sumber Dana')
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('administrator.name')
                    ->label('Administrator')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('work_program')
                    ->label('Program Kerja')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                        'external_expense' => 'Pengeluaran Eksternal',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'income' => 'success',
                        'expense' => 'warning',
                        'external_expense' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pemasukan')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'income')->count() . ' transaksi';
                            }),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pengeluaran')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'expense')->count() . ' transaksi';
                            }),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pengeluaran Eksternal')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'external_expense')->count() . ' transaksi';
                            }),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Semua Transaksi')
                            ->using(function () {
                                return \App\Models\MikatCash::count() . ' transaksi';
                            }),
                    ]),
                Tables\Columns\TextColumn::make('source_fund')
                    ->label('Sumber Dana')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->color(fn ($record): string => match ($record->type) {
                        'income' => 'success',
                        'expense' => 'warning',
                        'external_expense' => 'danger',
                        default => 'gray',
                    })
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pemasukan')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'income')->sum('amount');
                            })
                            ->money('IDR'),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pengeluaran')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'expense')->sum('amount');
                            })
                            ->money('IDR'),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Total Pengeluaran Eksternal')
                            ->using(function () {
                                return \App\Models\MikatCash::where('type', 'external_expense')->sum('amount');
                            })
                            ->money('IDR'),
                        Tables\Columns\Summarizers\Summarizer::make()
                            ->label('Saldo Bersih')
                            ->using(function () {
                                $income = \App\Models\MikatCash::where('type', 'income')->sum('amount');
                                $expense = \App\Models\MikatCash::where('type', 'expense')->sum('amount');
                                $externalExpense = \App\Models\MikatCash::where('type', 'external_expense')->sum('amount');
                                return $income - $expense - $externalExpense;
                            })
                            ->money('IDR'),
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Dihapus Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis')
                    ->options([
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                        'external_expense' => 'Pengeluaran Eksternal',
                    ]),
                Tables\Filters\SelectFilter::make('administrator_id')
                    ->label('Administrator')
                    ->relationship('administrator', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('date_range')
                    ->label('Rentang Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListMikatCashes::route('/'),
            'create' => Pages\CreateMikatCash::route('/create'),
            'edit' => Pages\EditMikatCash::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with(['administrator.division'])
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
