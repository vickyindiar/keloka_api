<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
        $profile = Profile::find($id);
        $profile->update($request->json()->all());
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS'), 'data' => $profile], 201);
    }

    public function destroy($id)
    {
        Profile::destroy([$id]);
        return response()->json(['status'=> true, 'msg' => config('msg.MSG_SUCCESS')], 200);
    }
}
