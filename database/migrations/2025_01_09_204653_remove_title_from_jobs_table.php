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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('subtitle');
            $table->dropColumn('location');
            $table->dropColumn('description');
            $table->dropColumn('responsibilities');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->mediumText('location')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('responsibilities')->nullable();

        });
    }
};
