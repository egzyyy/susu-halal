<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('password_otps', function (Blueprint $table) {
            $table->id();
            $table->string('user_table'); // donor, parent, doctor, etc.
            $table->unsignedBigInteger('user_id');
            $table->string('contact_or_email');
            $table->string('otp');
            $table->timestamp('expires_at');
            $table->timestamps();
            
            $table->index(['contact_or_email', 'expires_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_otps');
    }
};