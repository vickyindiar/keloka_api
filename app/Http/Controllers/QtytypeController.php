<?php

namespace App\Http\Controllers;

use App\Qtytype;
use Illuminate\Http\Request;
use App\Http\Resources\QtytypeCollection;
use Illuminate\Support\Facades\Validator;

class QtytypeController extends Controller
{

    public function index()
    {
        $qtyType = Qtytype::peginate();
        return new QtytypeCollection($qtyType);
    }

    public function store(Request $request)
    {
       $validate = Validator::make($request->all(),[
           'code' => 'required|string|max:5',
           'name' => 'required|string|max:30',
           'desc' => 'nullable|text'
       ]);

       if($validate->fails()){
        return response()->json($validate->errors()->toJson(), 400);
       }
       $qtyType = Qtytype::create([
        'code'      => $request->input('code'),
        'name'      => $request->input('name'),
        'desc'      => $request->input('desc')
       ]);
       return response()->json(['data' => $qtyType], 201);
    }

    public function show($id)
    {
        $qtyType = Qtytype::find($id);
        if($qtyType){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data'=> $qtyType], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $qtyType = Qtytype::find($id);
        if($qtyType){
            $qtyType->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $qtyType], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        $qtyType = Qtytype::find($id);
        if($qtyType){
            Qtytype::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }
}
