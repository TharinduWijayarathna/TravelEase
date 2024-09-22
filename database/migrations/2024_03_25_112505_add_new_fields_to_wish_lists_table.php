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
        Schema::table('wish_lists', function (Blueprint $table) {
            $table->bigInteger('customer_id')->nullable()->after('product_id');
            $table->string('customer_name')->nullable()->after('customer_id');
            $table->string('customer_address')->nullable()->after('customer_name');
            $table->string('customer_email')->nullable()->after('customer_address');
            $table->string('customer_contact_number')->nullable()->after('customer_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wish_lists', function (Blueprint $table) {
            //
        });
    }
};
