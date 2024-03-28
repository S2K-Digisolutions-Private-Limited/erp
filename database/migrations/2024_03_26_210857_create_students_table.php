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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("profile_image")->nullable();
            $table->string("name")->nullable();
            $table->string("student_id")->nullable();
            $table->string("school_id")->nullable();
            $table->boolean("status")->nullable()->default(1);
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->text("password")->nullable()->default(Hash::make('Student123'));
            $table->string("hidden_password")->nullable()->default('Student123');
            $table->string("gender", 10)->nullable();
            $table->string("father_name")->nullable();
            $table->string("mother_name")->nullable();
            $table->string("father_number")->nullable();
            $table->string("mother_number")->nullable();
            $table->string("whatsapp_number")->nullable();
            $table->string("primary_email")->nullable();
            $table->string("full_address")->nullable();
            $table->string("roll_number")->nullable();
            $table->string("class_id")->nullable();
            $table->string("section_id")->nullable();
            $table->string("stream_id")->nullable();
            $table->longText("about")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
