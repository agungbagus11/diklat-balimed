<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_id')->constrained('trainings')->cascadeOnDelete();
            $table->string('session_name', 150);
            $table->string('day_name', 30)->nullable();
            $table->date('session_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('quota')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('quiz_open_at')->nullable();
            $table->timestamp('quiz_close_at')->nullable();
            $table->string('material_link')->nullable();
            $table->string('diklat_link')->nullable();
            $table->timestamps();

            $table->index('session_date');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_sessions');
    }
};