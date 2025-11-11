<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Modify the enum column
            $table->enum('role', [
                'hmmc_admin',
                'nurse',
                'lab_technician',
                'doctor',
                'shariah_advisor',
                'parent',
                'donor'
            ])->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback to previous version if needed
            $table->enum('role', [
                'hmmc_admin',
                'nurse',
                'pediatrician',
                'shariah_advisor',
                'parent',
                'donor'
            ])->change();
        });
    }
};
