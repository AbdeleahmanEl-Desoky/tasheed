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
        Schema::create('blog_description_translations', function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->nullable();

            $table->unsignedBigInteger('blog_description_id')->index();
            $table->string('locale');
            $table->unique(['blog_description_id', 'locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_description_translations');
    }
};
