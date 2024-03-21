<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('role')->nullable()->default('Admin');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('school_name')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('school_id')->nullable();
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('pin_code', 10)->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->boolean('verify_status')->default(false);
            $table->string('affiliation_level')->nullable();
            $table->string('board_type')->nullable();
            $table->string('opt_code')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
