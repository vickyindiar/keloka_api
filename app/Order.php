<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = [
        'order_no', 'order_date', 'invoice_id', 'customer_id', 'user_id',
        'status', 'method', 'dp', 'stotal', 'due_date', 'shipping', 'others',
        'gdisc', 'gtotal'
    ];

    public function customers(){
        return $this->belongsTo(Customer::class);
    }

    public function invoices(){
        return $this->hasOne(Invoice::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
