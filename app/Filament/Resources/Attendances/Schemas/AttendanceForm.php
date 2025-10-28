<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->label('Employee ID')
                    
                    ->required(),
                DatePicker::make('date')
                    ->label('Date')
                    ->closeOnDateSelection()
                    ->required(),
                TimePicker::make('check_in')
                    ->label('Check In')
                    ->required()
                    ->reactive(),
                TimePicker::make('check_out')
                    ->label('Check Out')
                    ->required()
                    ->reactive(),
                    
                                
            ]);
            

        }
    
        private static function calculateHoursWorked(callable $set, callable $get): void
        {
            $checkIn = $get('check_in');
            $checkOut = $get('check_out');
    
            if ($checkIn && $checkOut) {
                $hoursWorked = (strtotime($checkOut) - strtotime($checkIn)) / 3600;
                $set('hours_worked', round($hoursWorked, 2));
            } else {
                $set('hours_worked', null);
            }
     }
}
