<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{

    public function index(): CategoryCollection
    {
        // $categories = Category::all();
        // return response()->json($categories);
        return new CategoryCollection(Category::paginate(2));
    }

    // public function index()
    // {
    //     $categories = Category::paginate(2);
    //     return response()->json($categories);
    // }



    public function show(Category $category): CategoryResource
    {
        // $category = Category::find($id);
        // return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $category], 200);
        return new CategoryResource($category);
    }


    public function store(Request $request)
    {
        $rule = [
            'code' => 'required|string|max:5',
            'name' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->json()->all(), $rule);

        if(! $validator->fails()){
            $category = Category::create($request->json()->all());
            return response()->json(['status'=> true, 'msg'=> config('msg.MSG_SUCCESS'), 'data' => $category], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->json()->all());
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $category], 201);
    }

    public function destroy($id)
    {
        Category::destroy([$id]);
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
    }
}
