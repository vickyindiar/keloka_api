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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->date('invoice_date');
            $table->string('status'); //lunas||belum lunas
            $table->string('method'); //cash||transfer
            $table->double('dp', 10, 2)->nullable(); //downpayment
            $table->double('stotal', 10, 2)->nullable(); //sub total
            $table->date('due_date')->nullable(); //jatuh tempo
            $table->double('shipping', 10, 2)->nullable(); //ongkir
            $table->double('others', 10, 2)->nullable(); //lainya
            $table->double('gdisc', 10, 2)->nullable(); //-> grand discount
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
        Schema::dropIfExists('invoices');
    }
}
