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
        Schema::create('feature_unit_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();

            $table->unsignedBigInteger('feature_unit_id')->index();
            $table->string('locale');
            $table->unique(['feature_unit_id', 'locale']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_unit_translations');
    }
};
