<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Role;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTExecption;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $result = [];
        $status = config('httpcode.HTTP_OK');
        $req = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer|max:5'
        ];
        $validator = Validator::make($request->all(), $req);
        if($validator->fails()){ return response()->json($validator->errors()->toJson(), 400);  }
        $role =  Role::find($request->input('role_id'));
        if($role){
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'role_id' => $request->input('role_id')
                ]);

                $profile = new Profile;
                $profile->name = $request->name;
                $profile->address = $request->address;
                $profile->phone = $request->phone;
                $profile->photo = $request->photo;
                $profile->desc = $request->desc;

                $user->profiles()->save($profile);

                $token = JWTAuth::fromUser($user);
                $req_code = config('httpcode.HTTP_CREATED');
                $status = true;
                $message = config('msg.MSG_SUCCESS');
                $data = compact('user', 'token');
                $result = compact('status', 'message', 'data');
                DB::commit();
            } catch (\Exception $e) {
               $req_code = config('httpcode.HTTP_BAD_REQUEST');
               $status['status'] = false;
               $result["message"] = $e->getMessage();
               DB::rollBack();
            }
        }
        else{
            $req_code = config('httpcode.HTTP_NOT_FOUND');
            $result['status'] = false;
            $result["message"] = config('msg.MSG_NODETECT');
        }

        return response()->json($result, $req_code);
    }


    public function login(Request $request)
    {
        $credentials = $request->all();
        $status = true;
        try {
            $token = JWTAuth::attempt($credentials);
            if(!$token){
                return response()->json(['status' => false, 'msg' => config('msg.ERR_CREDENT')], config('httpcode.HTTP_BAD_REQUEST'));
            }
            else{
                $fetchUser = auth()->user();
                $user = new User;
                $user->name = $fetchUser->name;
                $user->email = $fetchUser->email;
                $user->role_id = $fetchUser->role_id;
                $user->creted_at = $fetchUser->created_at;
                $user->updated_at = $fetchUser->updated_at;
                $data = compact('token', 'user');
            }
        } catch (JWTExecption $e) {
             return response()->json(['status' => false, 'msg' => config('msg.ERR_CREATE_TOKEN')], config('httpcode.HTTP_SERVER_ERROR'));
        }
        $message = config('msg.MSG_SUCCESS');
        return response()->json(compact('status', 'message', 'data'));
    }

    public function logout(Request $request){
        $token = $request->header('Authorization');
        try {
            JWTAuth::invalidate($token);
            return response()->json([ 'status' => true, 'msg' => config('msg.MSG_SUCCESS') ], 200);
        } catch (JWTExecption $th) {
            return response()->json(['status' => false, 'msg' => config('msg.MSG_FAILED')], 500);
        }
    }
}
