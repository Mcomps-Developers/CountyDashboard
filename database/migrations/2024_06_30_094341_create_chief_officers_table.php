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
        Schema::create('chief_officers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->longText('about_chief_officer');
            $table->string('department_title')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chief_officers');
    }
};
