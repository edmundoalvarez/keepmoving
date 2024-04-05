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
        Schema::create('purchases_have_products', function (Blueprint $table) {
            
            $table->foreignId('purchase_id')->constrained(table: 'purchases', column: 'purchase_id');
            $table->foreignId('product_id')->constrained(table: 'products', column: 'product_id');
            $table->integer('quantity')->default(1);
            $table->unsignedInteger('subtotal');
        
            $table->primary(['purchase_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_have_products');
    }
};
