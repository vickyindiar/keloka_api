<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $rule = [
            'code' => 'required|string|max:5',
            'name' => 'required|string|max:255'
        ];

        $validator = Validator::make($request->json()->all(), $rule);

        if(! $validator->fails()){
            $category = Category::create([
                'code' => $request->json()->get('code'),
                'name' => $request->json()->get('name'),
                'desc' => $request->json()->get('desc')
            ]);
            return response()->json(['status'=> true, 'msg'=> config('msg.MSG_SUCCESS'), 'data' => $category], 201);
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $category], 200);
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
