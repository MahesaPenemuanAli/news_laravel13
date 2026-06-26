<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Moderasi Komentar')
                    ->schema([
                        \Filament\Forms\Components\Select::make('article_id')
                            ->relationship('article', 'title')
                            ->disabled()
                            ->label('Artikel'),
                        \Filament\Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled()
                            ->label('Penulis Komentar'),
                        \Filament\Forms\Components\Select::make('parent_id')
                            ->relationship('parent', 'body')
                            ->disabled()
                            ->label('Dibalas Ke (Jika ada)'),
                        \Filament\Forms\Components\Toggle::make('is_approved')
                            ->label('Status Approve')
                            ->required(),
                        \Filament\Forms\Components\Textarea::make('body')
                            ->required()
                            ->label('Isi Komentar')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
