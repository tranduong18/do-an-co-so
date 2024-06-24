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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(null);
            $table->string('first_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('company_name')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('address_one')->nullable()->default(null);
            $table->string('address_two')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->text('note')->nullable()->default(null);
            $table->string('discount_code')->nullable()->default(null);
            $table->string('discount_amount')->default(0);
            $table->integer('shipping_id')->nullable()->default(null);
            $table->string('shipping_amount')->default(0);
            $table->string('total_amount')->default(0);
            $table->string('payment_method')->nullable()->default(null);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_delete')->default(0);
            $table->tinyInteger('is_payment')->default(0);
            $table->text('payment_data')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
