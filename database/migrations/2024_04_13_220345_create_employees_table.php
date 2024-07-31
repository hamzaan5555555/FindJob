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
        Schema::create('emplyees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->longText('educations')->nullable();
            $table->longText('certifications')->nullable();
            $table->longText('experiences')->nullable();
            $table->string('website')->nullable();
            $table->string('github')->nullable();
            $table->string('twitter')->nullable();
            $table->string('cv')->nullable();
            $table->boolean('reported')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplyees');
    }
};
