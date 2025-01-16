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
            $table->dropColumn(columns: 'title');
            $table->dropColumn(columns: 'sub_title');
            $table->dropColumn(columns: 'description');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('single_projects', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->mediumText('description')->nullable();

        });
    }
};
