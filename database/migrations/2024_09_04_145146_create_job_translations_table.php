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
        Schema::create('job_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->mediumText('location')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('responsibilities')->nullable();

            $table->unsignedBigInteger('job_id')->index();
            $table->string('locale');
            $table->unique(['job_id', 'locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_translations');
    }
};
