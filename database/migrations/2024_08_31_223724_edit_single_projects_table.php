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
        Schema::table('single_projects', function (Blueprint $table) {

            $table->string('type')->default('ongoing');
            $table->decimal('longitude')->nullable();
            $table->decimal('latitude')->nullable();

        });
    }

  /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('single_projects', function (Blueprint $table) {
            $table->dropColumn(columns: 'type');
            $table->dropColumn(columns: 'longitude');
            $table->dropColumn(columns: 'latitude');

        });
    }
};
