<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Inbox;
use Illuminate\Support\Facades\DB;


class userController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login', 'store', 'phoneStore', 'medsos','info', 'inbox']]);;
    }
    public function index(){
        $users = User::where('role','!=','2')->orderBy('created_at', 'DESC')->get();
        return view('userPage')->with('users',$users);
    }
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->fcm_token = $request->fcm_token;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'user_id' => $user->id,
            'success' => 'true'
        ], 200);
    }

    public function refreshToken(Request $request){
        $user = User::where('id', $request->id)->first();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return response()->json([
            'success' => 'success'
        ]);
    }

    public function inbox(Request $request){
        $inbox = Inbox::where('user_id', $request->user_id)->get();
        $result = array();

        foreach($inbox as $data){
            $var['title'] = $data->title;
            $var['content'] = $data->content;
            $result[] = $var;
        }
        return response()->json(
            $result
        , 200);
    }

    public function phoneStore(Request $request)
    {
        $user = User::find($request->id);
        $user->phone = $request->phone;
        $user->save();
        return response()->json([
            'success' => 'true'
        ], 200);
    }
    public function medsos(Request $request)
    {
        $check = User::where('email',$request->email)->where('password',$request->provider)->where('role','!=',0);
        if($check->count()<=0){
            //kalau belum registrasi
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->avatar = $request->avatar;
            $user->password = $request->provider;
            $user->fcm_token = $request->fcm_token;
            $user->save();
            return response()->json([
                'success' => 'true',
                'user_id' => $user->id,
                'phone' => $user->phone
            ], 200);
        }else{
            //sudah pernah registrasi ke login
            return response()->json([
                'success' => 'true',
                'user_id' => $check->first()->id,
                'phone' => $check->first()->phone
            ], 200);
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->where('role','!=',0)->first();
        // return $user;
        if(Hash::check($request->password, $user->password))
        {
            $user->fcm_token = $request->fcm_token;
            $user->save();

            return response()->json([
                'success' => 'true',
                'user_id' => $user->id
            ], 200);
        }else{
            return response()->json([
                'success' => 'false'
            ], 401);
        }
    }
    public function info(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        if(substr($user->avatar, 0, 4)!="http"){
            $avatar = "http://192.168.16.124/img/avatar/".$user->avatar;
        }else{
            $avatar = $user->avatar;
        }
        // return $user;
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $avatar,
            'no_hp' => $user->phone,
        ], 200);
    }
    public function block(Request $request)
    {
        $user = User::find($request->id);
        if($user->role != 0 ){
            $user->role = 0;
        }else{
            $user->role = 1;
        }
        if($user->save()){
            return redirect()->back();
        }
    }
    public function update(Request $request)
    {
        $user = User::where('id',$request->id);

        return response()->json([
            'succes' => 'true'
        ], 200);
    }
    public function editWeb(Request $request)
    {
        $user = User::find($request->id);
        return view('userEdit')->with('user',$user);
    }
    public function updateWeb(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if(!empty($request->file('avatar'))){
            Storage::delete('img/avatar/'.$user->avatar);
            $file       = $request->file('avatar');
            $fileName   = $user->name.sha1(time()). $file->getClientOriginalExtension();
            $request->file('avatar')->move("img/avatar", $fileName);

            $user->avatar = $fileName;
        }
        $user->save();
        return redirect()->back();
    }
}
