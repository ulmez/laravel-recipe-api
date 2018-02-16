<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;

class TokenController extends Controller
{
    public function auth(Request $request) {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 1,
                'message' => 'Validation failed.',
                'error' => $validator->errors()
            ], 422);
        }

        $token = JWTAuth::attempt($credentials);

        if($token) {
            //return response('Hello World', 200)->header('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWNpcGUtYXBpLnRlc3RcL2FwaVwvYXV0aFwvdG9rZW4iLCJpYXQiOjE1MTg2NDIzMTYsImV4cCI6MTUxODY0NTkxNiwibmJmIjoxNTE4NjQyMzE2LCJqdGkiOiJFTzkyWDFvWjZKTXVEam90Iiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.FZLXYgmetuRGHXkeHAKaxxq_hXL_NLAp__MdUQ3uFQM');
            return response()->json(['token' => $token], 200)->header('Authorization', 'Bearer ' . $token);
        } else {
            return response()->json(['code' => 2, 'message' => 'Invalid credentials.']);
        }
    }

    public function refresh() {
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::refresh($token);
            return response()->json(['token' => $token], 200);
        } catch(TokenExpiredException $e) {
            // Token cannot be refreshed, user needs to login
            throw new HttpResponseException(
                Response::json(['msg' => 'Need to Login Again'])
            );
        }
    }

    public function invalidate() {
        $token = JWTAuth::getToken();
        try {
            $token = JWTAuth::invalidate($token);
            return response()->json(['token' => $token], 200);
        } catch(Exception $e) {

        }
    }
}
