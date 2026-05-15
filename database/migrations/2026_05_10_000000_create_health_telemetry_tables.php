<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_sensor_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->string('type'); // heart_rate, temperature, motion, etc.
            $table->float('value');
            $table->string('unit')->nullable();
            $table->string('sensor_status')->default('valid'); // valid, noisy, disconnected
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('health_predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->string('prediction_type'); // fainting, fall, posture_anomaly
            $table->float('confidence');
            $table->boolean('is_critical')->default(false);
            $table->string('source_model'); // for debugging
            $table->integer('prediction_window_ms')->nullable(); // based on how many ms of data
            $table->json('details')->nullable();
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_predictions');
        Schema::dropIfExists('health_sensor_logs');
    }
};
