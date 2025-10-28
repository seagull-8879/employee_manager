<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalDepartments extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('total_departments', \App\Models\Department::count())
                ->label('Total Departments')
                ->description('Number of departments in the organization'),
        ];
    }
}
