<?php
use Illuminate\Support\Facades\DB;
use App\User;
if (!function_exists('infoUser')) {
    function infoUser($id)
    {
        return DB::table('users')->where('id',$id)->first();
    }
}
if (!function_exists('getSpesialis')) {
    function getSpesialis($name)
    {
        $spesialis = DB::table('teraphis')->where('nama',$name)->first()->spesialis;
        $spesialis = json_decode($spesialis,true);
        $result = null;
        
        foreach ($spesialis as $key => $data) {
          $result .= infoProduct($data['product_id'])->name.',';
        }
        return $result;
    }
}
