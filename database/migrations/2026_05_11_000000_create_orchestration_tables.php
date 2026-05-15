<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('health_prediction_id')->constrained('health_predictions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trip_id')->nullable()->constrained('trips')->nullOnDelete();
            $table->string('status')->default('open'); // open, resolved
            $table->string('severity')->default('info'); // info, warning, critical
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('incident_reports', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // health, emergency
            $table->unsignedBigInteger('event_id');
            $table->text('description')->nullable();
            $table->string('severity')->default('medium'); // low, medium, high, critical
            $table->string('status')->default('open'); // open, investigating, closed
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('decision_trace_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->unsignedBigInteger('event_id');
            $table->json('decisions');
            $table->text('reasoning')->nullable();
            $table->float('latency_ms');
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incident_reports');
        Schema::dropIfExists('health_alerts');
    }
};
