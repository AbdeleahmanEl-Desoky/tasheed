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
        Schema::table('abouts', function (Blueprint $table) {

            $table->integer('projects')->default(10);
            $table->integer('years_experience')->default(10);
            $table->integer('sold_unit')->default(3327);

        });
    }

  /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn('projects');
            $table->dropColumn('years_experience');
            $table->dropColumn('sold_unit');
        });
    }
};
