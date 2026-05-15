<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->json('start_location')->nullable();
            $table->json('end_location')->nullable();
            $table->string('status')->default('pending'); // pending, active, paused, emergency_paused, locally_stopped, completed, cancelled
            $table->string('navigation_mode')->default('manual'); // autonomous, manual, assisted
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->decimal('total_distance', 10, 2)->nullable();
            $table->integer('total_time')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('wheelchair_telemetry', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->json('position_data'); // Extensible structure (gps, local, indoor, floor, building)
            $table->float('speed')->default(0);
            $table->integer('battery_level')->nullable();
            $table->float('heading')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('timestamp_ms'); // High-precision sync
            $table->timestamps();
        });

        Schema::create('wheelchair_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->string('event_type');
            $table->json('event_data')->nullable();
            $table->string('severity')->default('info'); // info, warning, critical
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('ai_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->string('event_type'); // reroute, safety_override, rejected_command, local_stop
            $table->string('component_name');
            $table->text('message')->nullable();
            $table->json('decision_context')->nullable(); // state of the world at decision time
            $table->json('details')->nullable();
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('device_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->string('device_name');
            $table->string('connection_status')->default('offline'); // online, offline, reconnecting, degraded_connection
            $table->string('firmware_version')->nullable();
            $table->timestamp('last_heartbeat')->useCurrent();
            $table->timestamps();
        });

        Schema::create('obstacle_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->json('location')->nullable();
            $table->string('obstacle_type')->nullable();
            $table->float('distance_to_obstacle')->nullable();
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('trip_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
            $table->string('update_type');
            $table->string('source')->default('system'); // user, ai, assistant, system
            $table->json('update_data')->nullable();
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });

        Schema::create('emergency_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('e_chair_id')->constrained('e_chairs')->cascadeOnDelete();
            $table->foreignId('trip_id')->nullable()->constrained('trips')->nullOnDelete();
            $table->string('event_type');
            $table->string('source_classification')->default('hardware'); // obstacle, health, hardware, connectivity, battery, ai_failure
            $table->json('location')->nullable();
            $table->string('severity')->default('critical');
            $table->timestamp('resolved_at')->nullable();
            $table->unsignedBigInteger('timestamp_ms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emergency_events');
        Schema::dropIfExists('trip_updates');
        Schema::dropIfExists('obstacle_logs');
        Schema::dropIfExists('device_status');
        Schema::dropIfExists('ai_status_logs');
        Schema::dropIfExists('wheelchair_events');
        Schema::dropIfExists('wheelchair_telemetry');
        Schema::dropIfExists('trips');
    }
};
