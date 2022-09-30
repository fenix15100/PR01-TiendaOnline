<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // https://appdividend.com/2022/01/21/laravel-many-to-many-relationship/
        Schema::create('category_product', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignId('id_category')
                ->constrained('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_product')
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['id_category', 'id_product']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
