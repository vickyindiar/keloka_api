<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no');
            $table->date('order_date');

            $table->bigInteger('invoice_id')->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('status'); //lunas||belum lunas
            $table->string('method'); //cash||transfer
            $table->double('dp', 10, 2)->nullable();; //downpayment
            $table->double('stotal', 10, 2)->nullable();; //sub total
            $table->date('due_date')->nullable();; //jatuh tempo
            $table->double('shipping', 10, 2)->nullable();; //ongkir
            $table->double('others', 10, 2)->nullable();; //lainya
            $table->double('gdisc', 10, 2)->nullable(); //-> grand discount
            $table->double('gtotal', 10, 2); //-> grand total;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
