<?php
use Illuminate\Support\Facades\DB;
use App\User;
if (!function_exists('infoUser')) {
    function infoUser($id)
    {
        return DB::table('users')->where('id',$id)->first();
    }
}
