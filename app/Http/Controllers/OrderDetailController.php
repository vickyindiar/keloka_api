<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Resources\OrderDetailCollection;

class OrderDetailController extends Controller
{

    public function index(Request $request): OrderDetailCollection
    {
        $order_details = OrderDetail::with(['order:id,name', 'product:id,name', 'qtytype:id,name']);
        $order_details->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $order_details->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });

        return new OrderDetailCollection($order_details->paginate());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_id'      => 'required|integer',
            'product_id'    => 'required|integer',
            'qty'           => 'required|integer',
            'qtytype_id'    => 'required|integer',
            'disc'          => 'required|numeric',
            'price'         => 'required|numeric'
        ]);
        if($validate->fails()){ return response()->json($validate->errors()->toJson(), 400); }
        $order = OrderDetail::create([
            'order_id'     => $request->input('order_id'),
            'product_id'   => $request->input('product_id'),
            'qty'          => $request->input('qty'),
            'qtytype_id'   => $request->input('qtytype_id'),
            'disc'         => $request->input('disc'),
            'price'        => $request->input('price'),
        ]);
        return response()->json(['data' => $order], 201);
    }

    public function show($id)
    {
        $order = OrderDetail::find($id);
        if($order){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $order], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $order = OrderDetail::find($id);
        if($order){
            $order->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $order], 201);
        }
        else { return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404); }
    }

    public function destroy($id)
    {
        $order = OrderDetail::find($id);
        if($order == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            OrderDetail::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
