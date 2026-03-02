<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('training_category_id')->constrained('training_categories')->cascadeOnDelete();
            $table->string('code', 50)->unique();
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->string('organizer', 150)->nullable();
            $table->string('location', 150)->nullable();
            $table->enum('method', ['offline', 'online', 'hybrid'])->default('offline');
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->index('title');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};