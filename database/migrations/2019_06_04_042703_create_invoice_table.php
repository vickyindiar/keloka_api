<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('status'); //lunas||belum lunas
            $table->string('method'); //cash||transfer
            $table->double('dp', 10, 2); //downpayment
            $table->double('stotal', 10, 2); //sub total
            $table->date('due_date'); //jatuh tempo
            $table->double('shipping', 10, 2); //ongkir
            $table->double('others', 10, 2); //lainya
            $table->double('gdisc', 10, 2); //-> grand discount
            $table->double('gtotal', 10, 2); //-> grand total;
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
        Schema::dropIfExists('invoice');
    }
}
