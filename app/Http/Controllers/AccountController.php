<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
//use Auth;

class AccountController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth');
        //$this->middleware('auth:api');
    }

    public function index() {
        //$user = Auth::user();
        //dd($user);
        //return response()->json($user);
        //return view('api/auth/token');

        //$credentials = $request->only('email', 'password');
        //$token = JWTAuth::attempt(['token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWNpcGUtYXBpLnRlc3RcL2FwaVwvYXV0aFwvdG9rZW4iLCJpYXQiOjE1MTg2NTc3MTIsImV4cCI6MTUxODY2MTMxMiwibmJmIjoxNTE4NjU3NzEyLCJqdGkiOiJuSFdOblZuYXloaGVsR2plIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.rPXIxvtTbtRWhu8P79Em5UwfEZe9XkVf7wYaugLB1tg']);
        //JWTAuth::setRequest($request)->getToken();
        //return JWTAuth::getToken();

        if(JWTAuth::getToken()) {
            $user = JWTAuth::toUser();
            return response()->json($user);
        } else {
            return response()->json(['code' => 3, 'message' => 'Invalid token.']);
        }
        
    }
}
