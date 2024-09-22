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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('unit_price', 15, 2)->default(0);
            $table->integer('quantity')->nullable();
            $table->decimal('unit_discount', 15, 2)->default(0);
            $table->decimal('total_discount', 15, 2)->default(0);
            $table->integer('discount_type')->default(0);
            $table->decimal('sub_total', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->foreignId('cart_id')->nullable()->constrained('carts');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
