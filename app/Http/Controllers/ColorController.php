<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $data = Color::all();
        $model = new Color();
        $columns = $model->getTableColumns();
        return response()->json(compact('data', 'columns'));
    }

    public function store(Request $request)
    {
       $validate = Validator::make($request->all(),[
           'name' => 'required|string|max:30',
           'desc' => 'nullable|text'
       ]);

       if($validate->fails()){
        return response()->json($validate->errors()->toJson(), 400);
       }
       $color = Color::create([
        'name'      => $request->input('name'),
        'desc'      => $request->input('desc')
       ]);
       return response()->json(['data' => $color], 201);
    }

    public function show($id)
    {
        $color = Color::find($id);
        if($color){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data'=> $color], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        if($color){
            $color->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $color], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        if($color){
            Color::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }
}
