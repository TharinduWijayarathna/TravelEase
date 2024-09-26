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
        Schema::create('wish_lists', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->integer('status')->default(0);
            $table->integer('product_quantity')->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('product_discount')->nullable();
            $table->string('product_description')->nullable();
            $table->foreignId('bus_image_id')->nullable()->constrained('bus_images');
            $table->foreignId('bus_id')->nullable()->constrained('buses');
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wish_lists');
    }
};
