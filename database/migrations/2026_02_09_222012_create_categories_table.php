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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->timestamps();

            // $table->unsignedBigInteger('organization_id')->nullable()->index();
            // $table->unique(['name', 'parent_id']);
            // $table->unique(['name', 'parent_id', 'organization_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};