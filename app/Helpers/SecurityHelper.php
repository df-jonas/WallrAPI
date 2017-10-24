<?php

/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 24/10/2017
 * Time: 17:21
 */

namespace App\Helpers;

class SecurityHelper
{
    static public function generateRandom($length = 60)
    {
        $api_token = str_random($length);
        return $api_token;
    }
}