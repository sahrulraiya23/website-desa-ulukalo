<?php

namespace App\Filament\Resources\Apbdes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Support\RawJs;

class ApbdesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Data Utama APBDes')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('tahun')
                            ->numeric()
                            ->required(),

                        TextInput::make('pendapatan')
                            ->label('Pendapatan')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->disabled()
                            ->prefix('Rp'),

                        TextInput::make('belanja')
                            ->label('Belanja')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->disabled()
                            ->prefix('Rp'),

                        TextInput::make('pembiayaan_netto')
                            ->label('Pembiayaan Netto')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        TextInput::make('silpa_defisit')
                            ->label('SILPA/Defisit')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->disabled()
                            ->prefix('Rp'),
                    ])
                    ->columns(3),

                Section::make('Pendapatan')
                    ->schema([
                        Repeater::make('pendapatan_items')
                            ->relationship('pendapatanRincian')
                            ->schema([
                                TextInput::make('uraian')
                                    ->required(),

                                TextInput::make('anggaran')
                                    ->label('Anggaran')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(1),
                    ]),

                Section::make('Belanja')
                    ->schema([
                        Repeater::make('belanja_items')
                            ->relationship('belanjaRincian')
                            ->schema([
                                TextInput::make('bidang_kegiatan')
                                    ->required(),

                                TextInput::make('anggaran')
                                    ->label('Anggaran')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(1),
                    ]),
            ]);
    }
}
