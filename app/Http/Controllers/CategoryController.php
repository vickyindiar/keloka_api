<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{

    public function index(): CategoryCollection
    {
       $categories = Category::paginate(2);
       // return response()->json($categories);
        return new CategoryCollection($categories);
    }

    public function show($id){
        $category = Category::find($id);
        if($category){
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $category], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT'), 'data' => $category], 404);
        }
    }


    public function store(Request $request)
    {
        $rule = [
            'code' => 'required|string|max:5',
            'name' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->all(), $rule);

        if(! $validator->fails()){
            $category = Category::create($request->all());
            return response()->json(['status'=> true, 'msg'=> config('msg.MSG_SUCCESS'), 'data' => $category], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if($category == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            $category->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $category], 201);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Category::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
