<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|
            confirmed|
            min:8',
        ]);

        
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }
    public function getUsuarios()
    {
        $user = User::all();

        return \response()->json([$user],200);
    }
}
