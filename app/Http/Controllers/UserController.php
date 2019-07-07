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

class UserController extends Controller
{
    public function getuser()
    {
        try {
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['status' => false, 'msg'=> config('msg.ERR_USER')], 400);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredExceptions $e) {
            return response()->json(['status' => false, 'msg'=> config('msg.ERR_EXPIRED_TOKEN')], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidExceptions $e) {
            return response()->json(['status' => false, 'msg'=> config('msg.ERR_INVALID_TOKEN')], $e->getStatusCode());
        } catch (JWTExcaption $e) {
            return response()->json(['status' => false, 'msg'=> config('msg.ERR_ABSENT_TOKEN')], $e->getStatusCode());
        }
        return response()->json(['status' => true, "data" => $user]);
    }

}
