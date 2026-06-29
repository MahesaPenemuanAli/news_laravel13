<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identitas Kanal')
                ->description(
                    'Informasi ini tampil di halaman kategori publik dan meta SEO.',
                )
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(
                            fn ($set, ?string $state) => $set(
                                'slug',
                                Str::slug($state),
                            ),
                        ),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                    Select::make('parent_id')
                        ->relationship('parent', 'name')
                        ->label('Parent Category')
                        ->searchable()
                        ->preload()
                        ->nullable(),
                    Textarea::make('description')
                        ->label('Deskripsi Halaman')
                        ->helperText(
                            'Teks ini tampil sebagai intro hero halaman kategori. Buat singkat, editorial, dan menarik.',
                        )
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Pengaturan Tampilan')
                ->schema([
                    TextInput::make('icon_class')
                        ->label('Icon Class')
                        ->placeholder('fa fa-globe')
                        ->nullable(),
                    TextInput::make('order')
                        ->label('Urutan')
                        ->required()
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->required(),
                    Toggle::make('is_featured')
                        ->label('Tampilkan di Beranda / Mega Menu')
                        ->default(false)
                        ->required(),
                ])
                ->columns(2),
        ]);
    }
}
