<?php

namespace App\Filament\Resources\Menus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Informasi Menu')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nama Menu'),
                        \Filament\Forms\Components\Select::make('location')
                            ->options([
                                'header' => 'Header Navbar',
                                'footer' => 'Footer Menu',
                                'sidebar' => 'Sidebar Menu',
                            ])
                            ->required()
                            ->label('Lokasi'),
                    ])->columns(2),
                \Filament\Forms\Components\Section::make('Menu Items')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->label('Label Menu'),
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->label('Tautkan ke Kategori'),
                                \Filament\Forms\Components\Select::make('page_id')
                                    ->relationship('page', 'title')
                                    ->label('Tautkan ke Halaman'),
                                \Filament\Forms\Components\TextInput::make('url')
                                    ->url()
                                    ->label('Custom URL'),
                                \Filament\Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->default(0)
                                    ->label('Urutan'),
                                \Filament\Forms\Components\Toggle::make('is_active')
                                    ->default(true)
                                    ->label('Aktif'),
                            ])
                            ->orderColumn('order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->columns(2)
                    ])
            ]);
    }
}
