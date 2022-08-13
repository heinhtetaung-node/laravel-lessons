<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function postLogin(LoginRequest $request) {
        $userReq = $request->safe()->only(['email', 'password']);
        $user = CustomUser::where('email', $userReq['email'])->first(); // select * from customuser where eamil = ''
        if ($user == NULL) {
            return back()->withErrors([
                'email' => 'user not exist'
            ]);
        }
        
        $valid = Auth::attempt(['email' => $userReq['email'], 'password' => $userReq['password']]);
        if ($valid) {
            $request->session()->put('user', $user);
            // $userSession = $request->session()->get('user');
            // $request->session()->forget('user');
            // $userSession = $request->session()->get('user');
            return redirect('user');
        }
        return back()->withErrors([
            'password' => 'Your password is not correct!'
        ]);
    }

}
