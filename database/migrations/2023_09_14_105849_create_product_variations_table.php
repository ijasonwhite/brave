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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('size')->nullable();  // Assuming size can be a simple string value
            $table->string('color')->nullable();
            $table->string('SKU')->unique();
            $table->decimal('price', 8, 2);
            $table->integer('inventory')->default(0);
            $table->timestamps();
    
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
