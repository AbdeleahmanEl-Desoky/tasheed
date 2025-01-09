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
        Schema::create('project_page_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_page_id')->index();
            $table->string('locale');
            $table->unique(['project_page_id', 'locale']);

            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_page_translations');
    }
};
