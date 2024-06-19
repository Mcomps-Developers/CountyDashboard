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
        Schema::create('welcome_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Word from H.E The Governor');
            $table->longText('message')->default('Welcome to our county.');
            $table->string('quoted_text')->nullable();
            $table->string('name')->default('H.E Name');
            $table->string('designation')->default('Governor');
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('welcome_notes');
    }
};
