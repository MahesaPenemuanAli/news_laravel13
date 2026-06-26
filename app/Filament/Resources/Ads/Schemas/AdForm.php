<?php

namespace App\Filament\Resources\Ads\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Informasi Iklan')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nama Kampanye Iklan'),
                        \Filament\Forms\Components\Select::make('position')
                            ->options([
                                'header' => 'Header',
                                'sidebar' => 'Sidebar',
                                'in_content' => 'In Content',
                            ])
                            ->required()
                            ->label('Posisi Tayang'),
                        \Filament\Forms\Components\TextInput::make('target_url')
                            ->url()
                            ->required()
                            ->label('Link Tujuan')
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Banner Image')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('image_url')
                            ->image()
                            ->required()
                            ->label('Gambar Banner')
                            ->columnSpanFull(),
                    ]),

                \Filament\Forms\Components\Section::make('Jadwal Tayang & Status')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('start_date')
                            ->required()
                            ->label('Tanggal Mulai'),
                        \Filament\Forms\Components\DatePicker::make('end_date')
                            ->required()
                            ->label('Tanggal Berakhir'),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->label('Status Aktif')
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Statistik')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('impressions')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->label('Total Tayangan'),
                        \Filament\Forms\Components\TextInput::make('clicks')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->label('Total Klik'),
                    ])->columns(2),
            ]);
    }
}
