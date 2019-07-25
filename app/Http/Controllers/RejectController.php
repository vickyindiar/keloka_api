<?php

namespace App\Http\Controllers;

use App\Reject;
use Illuminate\Http\Request;
use App\Http\Resources\RejectCollection;

class RejectController extends Controller
{
    public function index(Request $request): RejectCollection
    {
        $reject = Reject::all();
        $reject->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $reject->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });

        return new RejectCollection($reject->paginate());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_id'     => 'required|integer',
            'qty'            => 'required|integer',
            'qtytype_id'     => 'nullable|integer'
        ]);
        if($validate->fails()){ return response()->json($validate->errors()->toJson(), 400); }
        $reject = Reject::create([
            'product_id'     => $request->input('product_id'),
            'qty'            => $request->input('qty'),
            'qtytype_id'     => $request->input('qtytype_id')
        ]);
        return response()->json(['data' => $reject], 201);
    }

    public function show($id)
    {
        $reject = Reject::find($id);
        if($reject){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $reject], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $reject = Reject::find($id);
        if($reject){
            $reject->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $reject], 201);
        }
        else { return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404); }
    }

    public function destroy($id)
    {
        $reject = Reject::find($id);
        if($reject == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Reject::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
