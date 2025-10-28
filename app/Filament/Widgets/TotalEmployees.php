<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalEmployees extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('total_employees', \App\Models\Employee::count())
                ->label('Total Employees')
                ->description('Number of employees in the organization'),
        ];
    }
}
