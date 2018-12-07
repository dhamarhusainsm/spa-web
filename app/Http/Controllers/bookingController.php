<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Booking;
use App\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Teraphi;
use App\Inbox;

class bookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['history', 'store']]);
    }
    //
    public function index(){
        $bookings = Booking::orderBy('created_at', 'DESC')->paginate(5);
        return view('book')->with('bookings', $bookings);
    }

    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->user_id = $request->user_id;
        $booking->order = $request->order;
        $booking->date = $request->date;
        $booking->save();
        return response()->json([
            'success' => 'true'
        ], 200);
    }
    public function history(Request $request){
        $booking = Booking::where('user_id', $request->user_id)->get();
        $result = array();
        foreach ($booking as $data) {
            $variable['order'] = DB::table('products')->where('id',$data->order)->first()->name;
            $variable['order_img'] = DB::table('products')->where('id',$data->order)->first()->image;
            $variable['order_desc'] = DB::table('products')->where('id',$data->order)->first()->description;
            // $variable['order'] = infoProduct($data->order)->name;
            // $variable['order_img'] = infoProduct($data->order)['image'];
            // $variable['order_desc'] = infoProduct($data->order)['description'];
            $variable['date'] = $data->date;
            $variable['status'] = $data->status;
            $result[] = $variable;
        }
        return response() -> json ([
            //  'result_booking_history' => $booking
             'result_booking_history' => $result
         ], 200);
    }
    public function infoWeb(Request $request){
        $booking = Booking::find($request->id);
        $pId= $booking->order;
        setlocale(LC_TIME, "IND");
        $day = strftime("%A", strtotime($booking->date));
        $teraphis = Teraphi::where('spesialis','LIKE','%"product_id":'.$pId.',"value":true%')->where('libur','!=','')->get();
        return view('bookingInfo')->with(compact('teraphis', 'booking'));
    }
    public function bookingCancel(Request $request){
        $title = 'Pesanan Dibatalkan';
        $body = $request->pesan;

        $booking = Booking::find($request->id);
        $booking->status = 'cancel';
        $booking->save();

        $optionBuilder = new OptionsBuilder();

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)->setSound('default');

        $inbox = new Inbox;
        $inbox->user_id = $booking->user_id;
        $inbox->title = $title;
        $inbox->content = $body;
        $inbox->save();

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = infoUser($booking->user_id)->fcm_token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        return redirect()->back();
    }
    public function bookingDone(Request $request){
        $teraphis = $request->teraphis;
        $ruangan = $request->room;
        $title = 'Pesanan Diterima';
        $body = 'Hore! Pesanan kamu telah diterima oleh Teraphis ' . $teraphis . ' di ruangan ' . $ruangan;

        $booking = Booking::find($request->id);
        $booking->status = "diterima";
        $booking->room = $request->room;
        $booking->save();

        //dd($request->teraphis);

        $optionBuilder = new OptionsBuilder();

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default');

        $inbox = new Inbox;
        $inbox->user_id = $booking->user_id;
        $inbox->title = $title;
        $inbox->content = $body;
        $inbox->teraphis = $request->teraphis;
        $inbox->save();

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = infoUser($booking->user_id)->fcm_token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();

        return redirect()->back();
    }
}
