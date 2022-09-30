<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('sku');
            $table->integer('quantity');
            $table->float('price',6,2);
            $table->timestamps();

            $table->foreignId('id_order')
                ->constrained('orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_product')->nullable()
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->unique(['id_order', 'id_product']);
            $table->unique(['sku', 'id_order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_lines');
    }
}
