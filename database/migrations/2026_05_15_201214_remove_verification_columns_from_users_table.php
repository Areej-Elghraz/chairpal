<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_verification_code',
                'email_verification_times_sent',
                'email_verification_code_expires_at'
            ]);
            $table->timestamp('email_verified_at')->default(DB::raw('CURRENT_TIMESTAMP'))->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_verification_code')->nullable();
            $table->tinyInteger('email_verification_times_sent')->nullable();
            $table->timestamp('email_verification_code_expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable()->change();
        });
    }
};
