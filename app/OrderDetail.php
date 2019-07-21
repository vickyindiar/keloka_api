<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
   protected $table = 'order_details';
   protected $fillable = ['order_id', 'product_id', 'qty', 'qtytype_id', 'disc', 'price'];


   public function orders(){
       return $this->belongsTo(Order::class);
   }

   public function order_details(){
       return $this->belongsTo(Product::class);
   }

   public function qtytypes(){
       return $this->belongsTo(Qtytype::class);
   }
}
