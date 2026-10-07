<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->timestamps();
            
            // A student can only have one attendance log record per day
            $table->unique(['user_id', 'date']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};