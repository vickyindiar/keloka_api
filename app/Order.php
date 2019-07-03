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
}
