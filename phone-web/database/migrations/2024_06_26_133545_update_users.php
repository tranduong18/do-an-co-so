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
        Schema::table('users', function (Blueprint $table) {

            $table->string('last_name')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('address_one')->nullable()->default(null);
            $table->string('address_two')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('company_name')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('country');
            $table->dropColumn('address_one');
            $table->dropColumn('address_two');
            $table->dropColumn('city');
            $table->dropColumn('postcode');
            $table->dropColumn('phone');
            $table->dropColumn('company_name');

        });
    }
};
