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
        Schema::create('governors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('main_manifesto')->default('Equality, Empowerment, Development');
            $table->date('date_of_birth');
            $table->string('office_phone')->nullable();
            $table->string('office_email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->text('welcome_message');
            $table->longText('about')->default('Write about the governor...');
            $table->string('photo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governors');
    }
};
