<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Resources\BrandCollection;

class BrandController extends Controller
{
    public function index(): BrandCollection
    {
        return new BrandCollection(Brand::paginate());
    }

    public function show($id){
        $brand = Brand::find($id);
        if($brand){
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $brand], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT'), 'data' => $brand], 404);
        }
    }

    public function store(Request $request)
    {
        $rule = ['code' => 'required|string|max:5', 'name' => 'required|string|max:255'];
        $validator = Validator::make($request->all(), $rule);
        if(! $validator->fails()){
            $brand = Brand::create($request->all());
            return response()->json(['status'=> true, 'msg'=> config('msg.MSG_SUCCESS'), 'data' => $brand], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        if($brand == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            $brand->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $brand], 201);
        }
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Brand::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
