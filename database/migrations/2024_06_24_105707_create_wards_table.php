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
        Schema::create('wards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subCounty_id');
            $table->string('name');
            $table->longText('short_description');
            $table->string('mca_name')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('subCounty_id')->references('id')->on('sub_counties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
