<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Http\Traits\ImageHandlerTrait;

class ProductController extends Controller
{
    use ImageHandlerTrait;

    public function index()
    {
        $products = Product::paginate();
        return new ProductCollection($products);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'        => 'required|string|max:50',
            'sprice'      => 'required|numeric|min:3',
            'bprice'      => 'required|numeric|min:3',
            'qtytype_id'  => 'required|numeric',
            'stock'       => 'required|numeric|min:1',
            'category_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'color'       => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'desc'        => 'nullable|string',

        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson(), 400);
        }
                         //  use ImageHandlerTrait;
        $resultUploaded = $this->uploadOne($request);
        $product = Product::create([
            'name'          => $request->input('name'),
            'sprice'        => $request->input('sprice'),
            'bprice'        => $request->input('bprice'),
            'qtytype_id'    => $request->input('qtytype_id'),
            'stock'         => $request->input('stock'),
            'category_id'   => $request->input('category_id'),
            'supplier_id'   => $request->input('supplier_id'),
            'color'         => $request->input('color'),
            'image'         => $resultUploaded,
            'desc'          => $request->input('desc'),
        ]);
        return response()->json(['data' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data'=>$product], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $resultUploaded = $this->uploadOne($request, $product);
            $requestData = $request->all();
            $requestData['photo'] = $resultUploaded;
            $product->update($requestData);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $product], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if($product == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Product::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
