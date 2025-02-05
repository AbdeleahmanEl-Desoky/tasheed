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
        Schema::create('single_project_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('sub_title')->nullable();
            $table->mediumText('description')->nullable();

            $table->unsignedBigInteger('single_project_id')->index();
            $table->string('locale');
            $table->unique(['single_project_id', 'locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_project_translations');
    }
};
