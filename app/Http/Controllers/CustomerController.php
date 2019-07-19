<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Traits\ImageHandlerTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CustomerCollection;


class CustomerController extends Controller
{
    use ImageHandlerTrait;

    public function index() : CustomerCollection
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
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'desc'      => 'nullable|string'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson(), 400);
        }

                         //  use ImageHandlerTrait;
        $resultUploaded = $this->uploadOne($request);
        $customer = Customer::create([
            'name'      => $request->input('name'),
            'address'   => $request->input('address'),
            'city'      => $request->input('city'),
            'province'  => $request->input('province'),
            'phone'     => $request->input('phone'),
            'phone2'    => $request->input('phone2'),
            'store'     => $request->input('store'),
            'photo'     => $resultUploaded,
            'desc'      => $request->input('desc')
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
            $resultUploaded = $this->uploadOne($request, $customer);
            $requestData = $request->all();
            $requestData['photo'] = $resultUploaded;
            $customer->update($requestData);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $customer], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if($customer){
            Customer::destroy($id);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }
}
