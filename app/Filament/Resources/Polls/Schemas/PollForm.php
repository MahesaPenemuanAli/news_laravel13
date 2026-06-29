<?php

namespace App\Filament\Resources\Polls\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PollForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Polling')
                    ->schema([
                        TextInput::make('question')
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                        DateTimePicker::make('expires_at'),
                    ])->columns(2),
                Section::make('Pilihan Jawaban')
                    ->schema([
                        Repeater::make('options')
                            ->relationship()
                            ->schema([
                                TextInput::make('option_text')
                                    ->required()
                                    ->label('Teks Pilihan'),
                                TextInput::make('votes_count')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(false),
                            ])->columns(2),
                    ]),
            ]);
    }
}
