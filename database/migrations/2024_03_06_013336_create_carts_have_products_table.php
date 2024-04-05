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
        Schema::create('carts_have_products', function (Blueprint $table) {
            $table->foreignId('cart_id')->constrained(table: 'carts', column: 'cart_id');
            $table->foreignId('product_id')->constrained(table: 'products', column: 'product_id');
            $table->integer('quantity')->default(1);
            $table->unsignedInteger('subtotal');
        
            $table->primary(['cart_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts_have_products');
    }
};
