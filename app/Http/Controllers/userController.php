<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class userController extends Controller
{
    //
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'success' => 'true'
        ], 200);
    }
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        // return $user;
        if(Hash::check($request->password, $user->password))
        {
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
        // return $user;
        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'no_hp' => $user->no_hp,
        ], 200);
    }
}
