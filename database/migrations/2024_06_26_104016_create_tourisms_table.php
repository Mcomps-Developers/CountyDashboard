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
        Schema::create('tourisms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('cover_image');
            $table->longText('images');
            $table->unsignedBigInteger('subcounty_id')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->foreign('subcounty_id')->references('id')->on('subcounties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourisms');
    }
};
