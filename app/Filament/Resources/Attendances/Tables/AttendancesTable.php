<?php

namespace App\Filament\Resources\Attendances\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")->label("ID")->sortable()->searchable(),
                TextColumn::make("employee.name")->label("Employee")->sortable()->searchable(),
                TextColumn::make("date")->label("Date")->date()->sortable()->searchable(),
                TextColumn::make("check_in")->label("Check In")->time()->sortable(),
                TextColumn::make("check_out")->label("Check Out")->time()->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
           
            ]);
    }
}
