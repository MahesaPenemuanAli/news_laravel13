<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalViews = \App\Models\Article::sum('views_count') ?? 0;
        $pendingArticles = \App\Models\Article::where('status', 'draft')->count();
        $totalSubscribers = \App\Models\Subscriber::count();

        return [
            Stat::make('Total Views', number_format($totalViews))
                ->description('Total tayangan semua artikel')
                ->descriptionIcon('heroicon-m-eye')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Artikel Pending Review', $pendingArticles)
                ->description('Artikel berstatus draft')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),
            Stat::make('Total Subscribers', number_format($totalSubscribers))
                ->description('Jumlah pelanggan newsletter')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
