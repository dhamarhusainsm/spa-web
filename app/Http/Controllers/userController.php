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
        $user->password = $request->password;
        $user->save();
        return response('succes', 200)->header('Content-Type', 'application/json');
    }
}
