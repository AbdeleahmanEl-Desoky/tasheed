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
        Schema::create('project_unit_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('single_project_unit_id');
            $table->unsignedBigInteger('feature_unit_id');

            $table->foreign('single_project_unit_id')->references('id')->on('single_project_units')->onDelete('cascade');
            $table->foreign('feature_unit_id')->references('id')->on('feature_units')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_unit_features');
    }
};
