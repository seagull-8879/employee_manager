<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Employee;
use Carbon\Carbon;

class RecentHires extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Employees hired this month
        $hiresThisMonth = Employee::whereMonth('join_date', Carbon::now()->month)->count();

        // Employees hired this week
        $hiresThisWeek = Employee::whereBetween('join_date', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
        ])->count();

        // Most recent hire
        $latestEmployee = Employee::latest('join_date')->first();

        return [
            Stat::make('Hires This Month', $hiresThisMonth)
                ->description('Employees joined this month')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),

            Stat::make('Hires This Week', $hiresThisWeek)
                ->description('New employees this week')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('info'),

            Stat::make('Latest Hire', $latestEmployee?->name ?? 'No data')
                ->description('Most recently joined employee')
                ->descriptionIcon('heroicon-m-user')
                ->color('warning'),
        ];
    }

    protected ?string $heading = 'Recent Hires Overview';
}