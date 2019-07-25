<?php

namespace App\Http\Controllers;


use App\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceCollection;

class InvoiceController extends Controller
{
    public function index(Request $request): InvoiceCollection
    {
        $invoice = Invoice::all();
        $invoice->when($request->has('where'), function($query) use ($request){
            return $query->where($request->where["1"], $request->where["2"], $request->where["3"]);
        });
        $invoice->when($request->has('orderby'), function($query) use ($request){
            return $query->orderBy($request->orderby);
        });

        return new InvoiceCollection($invoice->paginate());
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'invoice_no'      => 'required|string',
            'invoice_date'    => 'required|date',
            'note'           => 'nullable|string'
        ]);
        if($validate->fails()){ return response()->json($validate->errors()->toJson(), 400); }
        $invoice = Invoice::create([
            'invoice_no'     => $request->input('invoice_no'),
            'invoice_date'   => $request->input('invoice_date'),
            'note'          => $request->input('note')
        ]);
        return response()->json(['data' => $invoice], 201);
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        if($invoice){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $invoice], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if($invoice){
            $invoice->update($request->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $invoice], 201);
        }
        else { return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404); }
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if($invoice == null){
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
        else{
            Invoice::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
    }
}
