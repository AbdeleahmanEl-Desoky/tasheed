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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('location')->nullable();
            $table->string('job_type')->nullable();
            $table->string('salary')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('responsibilities')->nullable();
            $table->unsignedBigInteger('career_id');

            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
