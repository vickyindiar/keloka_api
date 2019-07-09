<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Resources\CustomerCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ImageHandlerTrait;

class CustomerController extends Controller
{
    use ImageHandlerTrait;

    public function index()
    {
        $customers = Customer::paginate();
        return new CustomerCollection($customers);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name'      => 'required|string|max:50',
            'address'   => 'required|string|max:100',
            'city'      => 'nullable|string',
            'province'  => 'nullable|string',
            'phone'     => 'nullable|string|max:12',
            'phone2'    => 'nullable|string|max:12',
            'store'     => 'nullable|string|max:50',
            //'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'desc'      => 'nullable|string'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson(), 400);
        }

        $resultUploaded = $this->uploadOne($request);

        $customer = Customer::create([
            'name'      => $request->json()->get('name'),
            'address'   => $request->json()->get('address'),
            'city'      => $request->json()->get('city'),
            'province'  => $request->json()->get('province'),
            'phone'     => $request->json()->get('phone'),
            'phone2'    => $request->json()->get('phone'),
            'store'     => $request->json()->get('store'),
            'photo'     => $resultUploaded,
            'desc'      => $request->json()->get('desc')
        ]);
        return response()->json(['data' => $customer], 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if($customer){
            return response()->json(['status'=>true, 'msg' => config('msg.MSG_SUCCESS'), 'data'=>$customer], 200);
        }
        else{
            return response()->json(['status'=>false, 'msg'=> config('msg.MSG_NODETECT')], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if($customer){
            $customer->update($request->json()->all());
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $customer], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        $category = Customer::find($id);
        if($category){
            Customer::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }
}
