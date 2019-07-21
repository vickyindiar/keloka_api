<?php

namespace App\Http\Controllers;

use App\Exchange;
use Illuminate\Http\Request;
use App\Http\Resources\ExchangeCollection;

class ExchangeController extends Controller
{
    public function index(Request $request): ExchangeCollection
    {
        $exchange = Exchange::all();
        $exchange->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $exchange->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });

        return new ExchangeCollection($exchange->paginate());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_id'      => 'required|integer',
            'product_id'    => 'required|integer',
            'qty'           => 'required|integer',
            'qtytype_id'    => 'required|integer',
            'type'          => 'required|string',
            'reason'        => 'required|string',
            'desc'          => 'nullable|string',
        ]);
        if($validate->fails()){ return response()->json($validate->errors()->toJson(), 400); }
        $exchange = Exchange::create([
            'order_id'      => $request->input('order_id'),
            'product_id '   => $request->input('product_id'),
            'qty'           => $request->input('qty'),
            'qtytype_id'    => $request->input('qtytype_id'),
            'type'          => $request->input('type'),
            'reason'        => $request->input('reason'),
            'desc'          => $request->input('desc')
        ]);
        return response()->json(['data' => $exchange], 201);
    }

    public function show($id)
    {
        $exchange = Exchange::find($id);
        if($exchange){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $exchange], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $exchange = Exchange::find($id);
        if($exchange){
            $exchange->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $exchange], 201);
        }
        else { return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404); }
    }

    public function destroy($id)
    {
        $exchange = Exchange::find($id);
        if($exchange == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Exchange::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
