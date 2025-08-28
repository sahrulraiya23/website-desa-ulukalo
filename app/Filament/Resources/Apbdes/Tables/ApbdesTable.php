<?php

namespace App\Filament\Resources\Apbdes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;

class ApbdesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('pendapatan')
                    ->label('Pendapatan')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('belanja')
                    ->label('Belanja')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('pembiayaan_netto')
                    ->label('Pembiayaan Netto')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                TextColumn::make('silpa_defisit')
                    ->label('SILPA/Defisit')
                    ->money('IDR', locale: 'id')
                    ->sortable()
                    ->color(fn($state): string => $state >= 0 ? 'success' : 'danger'),

                TextColumn::make('pendapatan_rincian_count')
                    ->label('Jumlah Pendapatan')
                    ->counts('pendapatanRincian')
                    ->badge()
                    ->color('info'),

                TextColumn::make('belanja_rincian_count')
                    ->label('Jumlah Belanja')
                    ->counts('belanjaRincian')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tahun')
                    ->label('Tahun')
                    ->options(function () {
                        $currentYear = now()->year;
                        $years = [];
                        for ($i = $currentYear - 5; $i <= $currentYear + 2; $i++) {
                            $years[$i] = $i;
                        }
                        return $years;
                    })
                    ->placeholder('Pilih Tahun'),

                Filter::make('surplus')
                    ->label('SILPA (Surplus)')
                    ->query(fn(Builder $query): Builder => $query->where('silpa_defisit', '>', 0)),

                Filter::make('defisit')
                    ->label('Defisit')
                    ->query(fn(Builder $query): Builder => $query->where('silpa_defisit', '<', 0)),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('Dibuat Dari'),
                        DatePicker::make('created_until')
                            ->label('Dibuat Sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat'),
                EditAction::make()
                    ->label('Edit'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->defaultSort('tahun', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100]);
    }
}
