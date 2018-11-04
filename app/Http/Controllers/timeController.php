<?php

use Carbon\Carbon;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class timeController extends Controller
{
    //
    public function index()
    {
        $start = \Carbon\Carbon::now()->setTime(0, 0, 0);
        $end = \Carbon\Carbon::now()->addDays(14)->setTime(0, 0, 0);
        $days = $start->diff($end)->days;

        for($i = 0; $i <= $days; $i++)
        {
            $date = $start->addDays(1);

            $time[$i]["date"] = $date->format('Y-m-d H:i:s');
            $timeCheck = $date->setTime(8, 0, 0);
            for($s=0;$s<9;$s++){
                $status["time"] = $timeCheck->format('H:i:s');
                if(DB::table('times')->where('date', $timeCheck->format('Y-m-d H:i:s') )->count() <=0){
                    $status["available"] = true;
                }else{
                    $status["available"] = false;
                }
                $time[$i][$s] = $status;
                $timeCheck->addHour(1);
            }
        }

        return response()->json([
            'result' => $time
        ], 200);
    }
}
