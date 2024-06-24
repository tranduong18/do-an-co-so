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
        Schema::table('category', function (Blueprint $table) {
            $table->tinyInteger('is_home')->default(0)
                ->comment('0:no, 1: yes')
                ->after('updated_at');
            $table->string('image_name')->nullable()->default(null);
            $table->string('button_name')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('is_home');
            $table->dropColumn('button_name');
            $table->dropColumn('image_name');

        });
    }
};
