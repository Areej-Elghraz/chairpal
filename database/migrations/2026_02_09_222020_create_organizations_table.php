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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('rate', 3, 2)->default(0);
            $table->foreignId('owner_id')->nullable()->constrained('users')->cascadeOnDelete();
            // $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->nullOnDelete();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            // $table->unique(['name']);
        });

        // Add foreign key constraint to categories table now that organizations exists
        // Schema::table('categories', function (Blueprint $table) {
        //     $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
