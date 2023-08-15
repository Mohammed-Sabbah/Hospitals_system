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
        Schema::create('hospital_major', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('hospital_id');
            $table->foreign('hospital_id')->on('hospitals')->references('id')->cascadeOnDelete();

            $table->unsignedBigInteger('major_id');
            $table->foreign('major_id')->on('majors')->references('id')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_major');
    }
};
