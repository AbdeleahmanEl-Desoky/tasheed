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
        Schema::create('about_vision_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_vision_id')->index();
            $table->string('locale');
            $table->unique(['about_vision_id', 'locale']);

            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('sub_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_vision_translations');
    }
};
