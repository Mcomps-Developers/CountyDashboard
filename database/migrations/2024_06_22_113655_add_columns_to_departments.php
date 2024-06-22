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
        Schema::table('departments', function (Blueprint $table) {
            // Cecm
            $table->string('cecm_name')->nullable();
            $table->string('cecm_photo')->nullable();
            $table->string('cecm_date_of_birth')->nullable();
            $table->string('cecm_department_phone')->nullable();
            $table->string('cecm_department_email')->nullable();
            $table->longText('about_cecm')->nullable();
            // Chief Office
            $table->string('chief_officer_name')->nullable();
            $table->string('chief_officer_photo')->nullable();
            $table->string('chief_officer_date_of_birth')->nullable();
            $table->string('chief_officer_department_phone')->nullable();
            $table->string('chief_officer_department_email')->nullable();
            $table->longText('about_chief_officer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            //
        });
    }
};
