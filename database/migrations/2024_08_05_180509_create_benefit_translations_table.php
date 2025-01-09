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
        Schema::create('benefit_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('benefit_id')->index();
            $table->string('locale');
            $table->unique(['benefit_id', 'locale']);

            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefit_translations');
    }
};
