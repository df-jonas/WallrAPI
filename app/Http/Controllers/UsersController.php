<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:39
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function Register()
    {
        return Auth::user();
    }

    public function Me()
    {
        return Auth::user();
    }
}