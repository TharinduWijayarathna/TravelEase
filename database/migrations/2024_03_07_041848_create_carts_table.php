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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(0);
            $table->string('created_by')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->decimal('sub_total',15, 2)->default(0);
            $table->decimal('discount',15, 2)->default(0);
            $table->integer('payment_type')->nullable();
            $table->decimal('customer_paid', 2, 2)->default(0);
            $table->decimal('total_tax', 15, 2)->default(0);
            $table->decimal('balance',15, 2)->default(0);
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
        Schema::dropIfExists('carts');
    }
};
