<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->integer('customerId');
            $table->string('order_date');
            $table->string('total_product');
            
            $table->string('order_status');
            $table->string('payment_status');
            $table->string('payment_method');
            $table->string('Shipping');
            $table->string('tax');
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('subTotal');
            $table->string('total');
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
