<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $table = 'invoices';
    protected $fillable = ['invoice_no', 'invoice_date', 'note'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
