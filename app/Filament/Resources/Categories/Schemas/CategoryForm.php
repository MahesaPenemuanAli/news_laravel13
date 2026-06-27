<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Informasi Kategori')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->label('Parent Category')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Pengaturan Tambahan')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('icon_class')
                            ->placeholder('fa fa-icon')
                            ->nullable(),
                        \Filament\Forms\Components\TextInput::make('order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        \Filament\Forms\Components\Toggle::make('is_featured')
                            ->label('Tampilkan di Beranda')
                            ->default(false)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
