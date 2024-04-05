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
        Schema::create('products_have_sizes', function (Blueprint $table) {

            $table->foreignId('product_id')->constrained(table: 'products', column: 'product_id');
            
            $table->foreignId('size_id')->constrained(table: 'sizes', column: 'size_id');
        
            $table->primary(['product_id', 'size_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_have_sizes');
    }
};
