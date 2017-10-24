<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:39
 */

namespace App\Http\Controllers;


use App\Helpers\SecurityHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function Register()
    {
        if (isset($request->device_name)) {

            $user = new User;
            $user->device_name = $request->device_name;
            $user->device_uuid = SecurityHelper::generateRandom(60);
            $user->device_verifytoken = SecurityHelper::generateRandom(60);
            $user->api_token = SecurityHelper::generateRandom(60);

            $user->save();

            return response()->json(array(
                "id" => $user->id,
                "device_name" => $user->device_name,
                "device_uuid" => $user->device_uuid,
                "device_verifytoken" => $user->device_verifytoken,
                "api_token" => $user->api_token,
            ));
        }

        return response()->json(['statuscode' => 400, 'message' => "@param 'device_name' not present."], 400);
    }

    public function Me()
    {
        return Auth::user();
    }
}