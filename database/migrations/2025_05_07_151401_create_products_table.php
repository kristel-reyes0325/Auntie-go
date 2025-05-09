<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('product_details');
            $table->string('product_image');
            $table->string('sold_as');
            $table->string('weight');
            $table->string('size');
            $table->string('composition');
            $table->string('color');
            $table->string('location');
            $table->text('issues')->nullable();
            $table->decimal('original_price', 10, 2);
            $table->decimal('retail_price', 10, 2);
            $table->timestamps();
            
            // Foreign key to categories table
            $table->foreignId('category_id')->constrained('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
