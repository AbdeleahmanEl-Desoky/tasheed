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
        Schema::create('about_gallery_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('about_gallery_id')->index();
            $table->string('locale');
            $table->unique(['about_gallery_id', 'locale']);

            $table->string('title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_gallery_translations');
    }
};
