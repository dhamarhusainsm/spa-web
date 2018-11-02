<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);
        return response()->json([
            'success' => 'true'
        ], 200);
    }
}
