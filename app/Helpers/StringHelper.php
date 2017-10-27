<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 27/10/2017
 * Time: 17:32
 */

namespace App\Helpers;


class StringHelper
{
    static public function mask($string, $char = 'x', $digits = 4) {
        if (strlen($string) > $digits) {
            $masksize = strlen($string) - $digits;
            return substr_replace($string, str_repeat($char, $masksize), 0, $masksize);
        }
        return $string;
    }
}