<?php

namespace App\Filament\Resources\Employees\Tables;


use Filament\Actions\DeleteAction;

use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->searchable(),
                TextColumn::make('position')
                    ->searchable(),
                TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('join_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('photo')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
                ]) 
            ->headerActions([
                CreateAction::make()
                    ->schema([
                        TextInput::make('department_id')
                            ->numeric(),
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->unique('employees','email')
                            ->required(),
                        TextInput::make('phone_number')
                            ->tel()
                            ->unique('employees','phone_number')
                            ->required(),
                        TextInput::make('position')
                            ->required(),
                        TextInput::make('salary')
                            ->required()
                            ->numeric(),
                        TextInput::make('join_date')
                            ->required(),
                        TextInput::make('photo'),
                    ])
                    
                ]);   
    }
}
