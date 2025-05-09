<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add the category_id column (foreign key to categories table)
            $table->unsignedBigInteger('category_id')->nullable();

            // Add foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key and column when rolling back
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
