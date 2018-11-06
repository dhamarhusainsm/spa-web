<?php
use Illuminate\Support\Facades\DB;
if (! function_exists('infoUser')) {
    function infoUser($id)
    {
        return DB::table('users')->where('id',$id)->first();
    }
}
