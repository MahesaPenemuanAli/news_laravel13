<?php

namespace App\Filament\Resources\Polls\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PollForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Detail Polling')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('question')
                            ->required()
                            ->columnSpanFull(),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        \Filament\Forms\Components\DateTimePicker::make('expires_at'),
                    ])->columns(2),
                \Filament\Forms\Components\Section::make('Pilihan Jawaban')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('options')
                            ->relationship()
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('option_text')
                                    ->required()
                                    ->label('Teks Pilihan'),
                                \Filament\Forms\Components\TextInput::make('votes_count')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false)
                            ])->columns(2)
                    ])
            ]);
    }
}
