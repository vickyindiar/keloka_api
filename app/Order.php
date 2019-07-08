<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'order_no', 'order_date', 'invoice_id', 'customer_id', 'user_id',
        'status', 'method', 'dp', 'stotal', 'due_date', 'shipping', 'others',
        'gdisc', 'gtotal'
    ];

    public function customers(){
        $this->belongsTo(Customer::class);
    }

    public function invoices(){
        $this->belongsTo(Invoice::class);
    }

    public function users(){
        $this->belongsTo(User::class);
    }
}
