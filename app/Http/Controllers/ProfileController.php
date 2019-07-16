<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\Http\Traits\ImageHandlerTrait;

class ProfileController extends Controller
{
    use ImageHandlerTrait;

    public function index()
    {
        return respons()->json(Profile::all());
    }

    public function show($id)
    {
       $profile = Profile::find($id);
       return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $profile], 200);
    }

    public function update(Request $request, $id)
    {
        $profile = Customer::find($id);
        if($profile){
            $resultUploaded = $this->uploadOne($request, $profile);
            $requestData = $request->all();
            $requestData['photo'] = $resultUploaded;
            $profile->update($requestData);
            return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $profile], 201);
        }
        else{
            return response()->json(['status'=> false, 'msg' => config('msg.MSG_NODETECT')], 404);
        }
    }

    public function destroy($id)
    {
        Profile::destroy([$id]);
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
    }
}
