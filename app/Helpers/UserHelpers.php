<?php
use Illuminate\Support\Facades\DB;
use App\User;
if (!function_exists('infoUser')) {
    function infoUser($id)
    {
        return DB::table('users')->where('id',$id)->first();
    }
}
if (!function_exists('randomAvatarName')) {
    function randomAvatarName($length) {
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }
}
