<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCollection;
use App\Http\Traits\ImageHandlerTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    use ImageHandlerTrait;

    public function index(Request $request) // : ProductCollection
    {
        $data = Product::with([
            'qtytype' => function($query){ $query->select(['id', 'name'])->get(); },
            'category' => function($query){ $query->select(['id', 'name'])->get(); },
            'supplier' => function($query){ $query->select(['id', 'name'])->get(); },
            'brand:id,name', 'color:id,name'])->get();

        $data->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $data->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });
        $model = new Product();
        $columns = $model->getTableColumns();
        return response()->json(compact('data', 'columns'));
        //return new ProductCollection($products->paginate());
    }

    public function productDataSupport(Request $request){
        $category = DB::table('categories')->get();
        $supplier = DB::table('suppliers')->get();
        $brand = DB::table('brands')->get();
        $qtytype = DB::table('qtytypes')->get();
        $color = DB::table('colors')->get();
        return response()->json(compact('category', 'supplier', 'brand', 'qtytype', 'color'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'        => 'required|string|max:50',
            'brand_id'    => 'required|numeric|min:1',
            'sprice'      => 'required|numeric|min:1',
            'bprice'      => 'required|numeric|min:1',
            'qtytype_id'  => 'required|integer',
            'stock'       => 'required|numeric|min:1',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'color_id'    => 'nullable|string',
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
            'brand'         => $request->input('brand'),
            'sprice'        => $request->input('sprice'),
            'bprice'        => $request->input('bprice'),
            'qtytype_id'    => $request->input('qtytype'),
            'stock'         => $request->input('stock'),
            'category_id'   => $request->input('category'),
            'supplier_id'   => $request->input('supplier'),
            'color_id'      => $request->input('color'),
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
