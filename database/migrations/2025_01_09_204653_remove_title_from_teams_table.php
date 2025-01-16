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
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(columns: 'name');
            $table->dropColumn(columns: 'description');
            $table->dropColumn(columns: 'job_name');
            $table->dropColumn(columns: 'job_rank');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('job_name')->nullable();
            $table->string('job_rank')->nullable();

        });
    }
};
