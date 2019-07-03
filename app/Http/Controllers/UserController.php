<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Profile;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTExecption;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Config;
use Dotenv\Regex\Result;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $result = [];
        $status = Config::get('msg._HTTP_OK');
        $req = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer|max:5'
        ];
        $validator = Validator::make($request->all(), $req);
        if($validator->fails()){ return response()->json($validator->errors()->toJson(), 400);  }
        $role =  Role::find($request->json()->get('role_id'));
        if($role){
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $request->json()->get('name'),
                    'email' => $request->json()->get('email'),
                    'password' => Hash::make($request->json()->get('password')),
                    'role_id' => $request->json()->get('role_id')
                ]);
                $user->roles()->attach($request->json()->get('role_id'));

                $profile = new Profile();
                $profile->name = $request->name;
                $profile->adress = $request->address;
                $profile->phone = $request->phone;
                $profile->photo = $request->photo;
                $profile->desc = $request->desc;
               // $profile->save($user);
                $user->profiles()->save($profile);

                $token = JWTAuth::fromUser($user);

                $req_code = Config::get('msg._HTTP_CREATED');
                $stats = true;
                $message = Config::get('msg._insert_success');
                $data = compact('user', 'token');

                $result = compact('stats', 'message', 'data');

                DB::commit();
            } catch (\Exception $e) {
               DB::rollBack();
               $status = Config::get('msg._HTTP_BAD_REQUEST');
               $result['stats'] = false;
               $result["message"] = $e->getMessage();
            }
        }
        else{
            $status = Config::get('msg._HTTP_NOT_FOUND');
            $result['stats'] = false;
            $result["message"] = Config::get('msg._role_not_found');
        }

        return response()->json($result, $status);
    }


    public function login(Request $request)
    {
        $credentials = $request->json()->all();
        try {
            $token = JWTAuth::attempt($credentials);
            if(!$token){
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTExecption $e) {
             return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function logout(Request $request){
        $token = $request->header('Authorization');
        try {
            JWTAuth::invalidate($token);
            return response()->json([ 'success' => true ], 200);
        } catch (JWTExecption $th) {
            return response()->json(['error' => 'logout failed'], 500);
        }
    }

    public function getuser()
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'], 400);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredExceptions $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidExceptions $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTExcaption $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

}
