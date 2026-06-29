<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Moderasi Komentar')
                    ->schema([
                        Select::make('article_id')
                            ->relationship('article', 'title')
                            ->disabled()
                            ->label('Artikel'),
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled()
                            ->label('Penulis Komentar'),
                        Select::make('parent_id')
                            ->relationship('parent', 'body')
                            ->disabled()
                            ->label('Dibalas Ke (Jika ada)'),
                        Toggle::make('is_approved')
                            ->label('Status Approve')
                            ->required(),
                        Textarea::make('body')
                            ->required()
                            ->label('Isi Komentar')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
