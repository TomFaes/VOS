<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    /**
     * This function wil return a token when credientials are correct. This
     * token can be used to make use of the api by sending this token in the request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->Email,
            'password' => $request->Password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('VosLoginApi')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
