<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('ammount',6,2);
            $table->string('shipping_address',450);
            $table->string('order_email',256);
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('order_status',
                ['BILLING_PENDING',
                'PENDING',
                'COMPLETED',
                'CANCELED',
                'FAILED',
                'REFUND']
            )->default("PENDING");
            $table->string('full_name',150)->nullable();
            $table->string('billing_address',450);
            $table->string('country',100)->nullable();
            $table->string('phone',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
