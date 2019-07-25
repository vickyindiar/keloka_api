<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{

    public function index(Request $request): OrderCollection
    {
        $orders = Order::with([
            'qtytype' => function($query){ $query->select(['id', 'name'])->get(); },
            'category' => function($query){ $query->select(['id', 'name'])->get(); },
            'supplier' => function($query){ $query->select(['id', 'name'])->get(); },
            'brand:id,name']);

        $orders->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $orders->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });

        return new OrderCollection($orders->paginate());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'order_no'      => 'required|string|max:50',
            'order_date'    => 'required|date',
            'invoice_id'    => 'required|numeric',
            'customer_id'   => 'required|numeric',
            'user_id'       => 'required|numeric',
            'status'        => 'required|numeric',
            'method'        => 'required|numeric',
            'dp'            => 'nullable|string',
            'stotal'        => 'required|numeric',
            'due_date'      => 'nullable|date',
            'shipping'      => 'nullable|numeric',
            'others'        => 'nullable',
            'gdisc'         => 'nullable|numeric',
            'gtotal'        => 'reuqired|numeric'
        ]);
        if($validate->fails()){ return response()->json($validate->errors()->toJson(), 400); }
        $order = Order::create([
            'order_no'     => $request->input('order_no'),
            'order_date'   => $request->input('order_date'),
            'invoice_id'   => $request->input('invoice_id'),
            'customer_id'  => $request->input('customer_id'),
            'user_id'      => $request->input('user_id'),
            'status'       => $request->input('status'),
            'method'       => $request->input('method'),
            'dp'           => $request->input('dp'),
            'stotal'       => $request->input('stotal'),
            'due_date'     => $request->input('due_date'),
            'shipping'     => $request->input('shipping'),
            'others'       => $request->input('others'),
            'gdisc'        => $request->input('gdisc'),
            'gtotal'       => $request->input('gtotal')
        ]);
        return response()->json(['data' => $order], 201);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if($order){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $order], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if($order){
            $order->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $order], 201);
        }
        else { return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404); }
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if($order == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Order::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
