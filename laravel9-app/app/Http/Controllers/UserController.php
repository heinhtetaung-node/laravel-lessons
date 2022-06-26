<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use App\Http\Requests\UserPostRequest;

class UserController extends Controller
{
    //
    public function index() {
        $users = CustomUser::all();
        return view('user/index', [ 'users' => $users ]);
    }

    public function create() {
        return view('user/create');
    }

    public function create2() {
        return view('user/create2');
    }

    public function insert(Request $request) {

        $validatedData = $request->validate([
            'name' => ['required'],
            'nickname' => ['required_with:name'],
            'email' => ['required', 'email', 'unique:custom_user'],
            'address' => ['required', 'min:5'],
        ]);        

        $customer = $request->only(['name', 'email', 'address', 'nickname']);        

        $customUser = new CustomUser();
        $customUser->name = $customer['name'];
        $customUser->nickname = $customer['nickname'];
        $customUser->email = $customer['email'];
        $customUser->address = $customer['address'];
        $res = $customUser->save();        
    }

    public function insert2(UserPostRequest $request) {
        $customer = $request->safe()->only(['name', 'email', 'address', 'nickname', 'id']);
        // var_dump($customer); exit;
        $customUser = new CustomUser();
        if (isset($customer['id']) == 1) {
            $customUser = CustomUser::findOrFail($customer['id']);  
            // var_dump($customUser);      exit;     
        }
        $customUser->name = $customer['name'];
        $customUser->nickname = $customer['nickname'];
        $customUser->email = $customer['email'];
        $customUser->address = $customer['address'];
        $res = $customUser->save();    
        
        if ($res == true) {
            return redirect('/user');
        }
    }

    public function edit($id) {
        $user = CustomUser::findOrFail($id);
        return view('user/edit', ['user' => $user]);
    }

    public function delete($id) {
        $user = CustomUser::findOrFail($id);
        $user->delete();
        return redirect('/user');
    }
}
