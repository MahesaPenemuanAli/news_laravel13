<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Menu')
                ->description(
                    'Menu header digunakan untuk navbar utama dan mega menu publik.',
                )
                ->schema([
                    TextInput::make('name')->required()->label('Nama Menu'),
                    Select::make('location')
                        ->options([
                            'header' => 'Header Navbar',
                            'footer' => 'Footer Menu',
                            'sidebar' => 'Sidebar Menu',
                        ])
                        ->required()
                        ->label('Lokasi'),
                ])
                ->columns(2),

            Section::make('Menu Items')
                ->description(
                    'Tambahkan item utama dan submenu. Item dengan children akan tampil sebagai dropdown di navbar.',
                )
                ->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->label('Label Menu'),
                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->searchable()
                                ->preload()
                                ->label('Tautkan ke Kategori'),
                            Select::make('page_id')
                                ->relationship('page', 'title')
                                ->searchable()
                                ->preload()
                                ->label('Tautkan ke Halaman'),
                            TextInput::make('url')
                                ->label('Custom URL')
                                ->helperText(
                                    'Gunakan /path untuk internal atau URL lengkap untuk eksternal.',
                                ),
                            TextInput::make('order')
                                ->numeric()
                                ->default(0)
                                ->label('Urutan'),
                            Toggle::make('is_active')
                                ->default(true)
                                ->label('Aktif'),
                            Repeater::make('children')
                                ->relationship('children')
                                ->label('Submenu / Dropdown')
                                ->schema([
                                    TextInput::make('title')
                                        ->required()
                                        ->label('Label Submenu'),
                                    Select::make('category_id')
                                        ->relationship('category', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->label('Kategori'),
                                    Select::make('page_id')
                                        ->relationship('page', 'title')
                                        ->searchable()
                                        ->preload()
                                        ->label('Halaman'),
                                    TextInput::make('url')->label('Custom URL'),
                                    TextInput::make('order')
                                        ->numeric()
                                        ->default(0)
                                        ->label('Urutan'),
                                    Toggle::make('is_active')
                                        ->default(true)
                                        ->label('Aktif'),
                                ])
                                ->orderColumn('order')
                                ->collapsible()
                                ->collapsed()
                                ->itemLabel(
                                    fn (array $state): ?string => $state[
                                        'title'
                                    ] ?? null,
                                )
                                ->columns(2)
                                ->columnSpanFull(),
                        ])
                        ->orderColumn('order')
                        ->collapsible()
                        ->itemLabel(
                            fn (array $state): ?string => $state['title'] ??
                                null,
                        )
                        ->columns(2),
                ]),
        ]);
    }
}
