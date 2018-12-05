<?php
use Illuminate\Support\Facades\DB;
use App\price;
if (!function_exists('infoTeraphis')) {
    function infoTeraphis($pId)
    {
        return DB::table('teraphis')->where('spesialis','LIKE','%"product_id":'.$pId.',"value":true%')->first();
    }
}
