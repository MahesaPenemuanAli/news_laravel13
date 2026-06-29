<?php

namespace App\Filament\Resources\Ads\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Iklan')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nama Kampanye Iklan'),
                        Select::make('position')
                            ->options([
                                'header' => 'Header',
                                'sidebar' => 'Sidebar',
                                'in_content' => 'In Content',
                            ])
                            ->required()
                            ->label('Posisi Tayang'),
                        TextInput::make('target_url')
                            ->url()
                            ->required()
                            ->label('Link Tujuan')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Banner Image')
                    ->schema([
                        FileUpload::make('image_url')
                            ->image()
                            ->required()
                            ->label('Gambar Banner')
                            ->columnSpanFull(),
                    ]),

                Section::make('Jadwal Tayang & Status')
                    ->schema([
                        DatePicker::make('start_date')
                            ->required()
                            ->label('Tanggal Mulai'),
                        DatePicker::make('end_date')
                            ->required()
                            ->label('Tanggal Berakhir'),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->label('Status Aktif')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Statistik')
                    ->schema([
                        TextInput::make('impressions')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->label('Total Tayangan'),
                        TextInput::make('clicks')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->label('Total Klik'),
                    ])->columns(2),
            ]);
    }
}
