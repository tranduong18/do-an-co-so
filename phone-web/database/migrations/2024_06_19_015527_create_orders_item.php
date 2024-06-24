<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpOption\None;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_item', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable()->default(null);
            $table->integer('product_id')->nullable()->default(null);
            $table->integer('quantity')->default(0);
            $table->string('price')->nullable()->default(0);
            $table->string('color_name')->nullable()->default(null);
            $table->string('size_name')->default(null);
            $table->string('size_amount')->default(0);
            $table->string('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_item');
    }
};
