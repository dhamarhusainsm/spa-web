<?php

use \Carbon\Carbon;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\time;
use App\User;


class timeController extends Controller
{
    //
    public function index(Request $request)
    {
        $date = \Carbon\Carbon::parse($request->date);
        // $time["date"] = $date->format('Y-m-d H:i:s');
            $timeCheck = $date->setTime(8, 0, 0);
            for($s=0;$s<9;$s++){
                $status["time"] = $timeCheck->format('H:i:s');
                if(DB::table('times')->where('date', $timeCheck->format('Y-m-d H:i:s') )->count() <=0){
                    $status["available"] = true;
                }else{
                    $status["available"] = false;
                }
                $time[] = $status;
                $timeCheck->addHour(1);
            }
            //SELECT DATE_FORMAT(date, "%Y-%m-%d") as 'date' from times order by date
            // if(DB::table('times')->raw("DATE_FORMAT(date, '%Y-%m-%d') as date") == date('2018-11-6')){
                // } else {
                    //     $reason = "tidak ada gangguam";
                    // }

        return response()->json([
            'result_available_time' => $time,
        ], 200);
    }
    public function busy()
    {
        $db = time::select('date', 'reason')->get();

        return response()->json([
            'time' => $db,
        ], 200);
    }
}
