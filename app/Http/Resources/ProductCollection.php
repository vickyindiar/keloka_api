<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return [
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'sprice' => $this->sprice,
            // 'bprice' => $this->bprice
            // 'qtytype' => $this->qtytype->name,
            // 'stock' => $this->stock,
            // 'category' => $this->category->name,
            // 'supplier' => $this->supplier->name,
            // 'brand' => $this->brand->name,
            // 'color' => $this->color,
            // 'image' => $this->image,
            // 'desc' => $this->desc
       // ];

        return parent::toArray($request);
    }
}
