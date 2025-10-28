<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('department_id')
                    ->label('Department')
                    ->options(\App\Models\Department::pluck('name','id')->toArray())
                    ,
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->unique('employees','email',ignoreRecord: true)
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->unique('employees','phone_number',ignoreRecord: true)
                    ->required(),
                TextInput::make('position')
                    ->required(),
                TextInput::make('salary')
                    ->required()
                    ->numeric(),
                DatePicker::make('join_date')
                    ->required(),
                TextInput::make('photo')
                    
                    ->nullable(),
            ]);
    }
}
