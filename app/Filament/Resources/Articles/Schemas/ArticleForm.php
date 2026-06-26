<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Konten Utama')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (\Filament\Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Media')
                    ->schema([
                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('images')
                            ->image()
                            ->columnSpanFull(),
                    ]),

                \Filament\Forms\Components\Section::make('Kategori & Tags')
                    ->schema([
                        \Filament\Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Category'),
                        \Filament\Forms\Components\Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->label('Tags'),
                    ])->columns(2),

                \Filament\Forms\Components\Section::make('Pengaturan & SEO')
                    ->schema([
                        \Filament\Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required()
                            ->label('Author')
                            ->default(fn() => auth()->id()),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'review' => 'Review',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('draft')
                            ->required(),
                        \Filament\Forms\Components\DateTimePicker::make('published_at'),
                        \Filament\Forms\Components\Toggle::make('is_breaking_news'),
                        \Filament\Forms\Components\Toggle::make('is_featured'),
                        \Filament\Forms\Components\Toggle::make('is_premium'),
                        \Filament\Forms\Components\Textarea::make('excerpt')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\TextInput::make('meta_title'),
                        \Filament\Forms\Components\Textarea::make('meta_description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
