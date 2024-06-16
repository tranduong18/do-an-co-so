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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->default(null);
            $table->string('sku')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            
            $table->integer('category_id')->nullable()->default(null);
            $table->integer('sub_category_id')->nullable()->default(null);
            $table->integer('brand_id')->nullable()->default(null);
            $table->double('price')->default(0);
            $table->double('old_price')->default(0);
            $table->text('description')->nullable()->default(null);
            $table->longtext('short_description')->nullable()->default(null);
            $table->text('additional_information')->nullable()->default(null);
            $table->text('shipping_returns')->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null);
            $table->tinyInteger('status')->default(0)->comment('0: active, 1: inactive');
            $table->tinyInteger('is_delete')->default(0)->comment('0: not delete, 1: delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
