<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable()->after('id');
            //adds a nullable foreign key column 'department_id' to 'employees' table
            //this column will be after the 'id' column in the table
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            //defines foreign key constraint for 'department_id' referencing 'id' on 'departments' table
            //if the referenced department is deleted, set 'department_id' to null
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
