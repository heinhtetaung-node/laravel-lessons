<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function postLogin(LoginRequest $request) {
        $user = $request->safe()->only(['email', 'password']);
        $user = User::where('email', $user['email'])->first();
        if ($user == NULL) {
            return back()->withErrors([
                'email' => 'user not exist'
            ]);
        }
        $user->password = 
        return redirect('user');
    }

}
