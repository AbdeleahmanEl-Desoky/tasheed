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
        Schema::create('single_project_unit_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();

            $table->unsignedBigInteger('single_project_unit_id')->index();
            $table->string('locale');
            $table->unique(['single_project_unit_id', 'locale'], 'spu_id_locale_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('single_project_unit_translations');
    }
};
