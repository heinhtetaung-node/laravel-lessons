<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request) {
        // $userSession = $request->session()->get('user');
        // var_dump($userSession);
        $para = ['orderBy' => 'id', 'order' => 'desc'];
        if ($request->has('orderBy')) {
            $para['orderBy'] = $request->input('orderBy');
        }
        if ($request->has('order')) {
            $para['order'] = $request->input('order');
        }
        
        $users = CustomUser::orderBy($para['orderBy'], $para['order'])->paginate(5)->withQueryString();
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
        $customer = $request->safe()->only(['name', 'email', 'address', 'nickname', 'id', 'password']);
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
        if ($customer['password'] != NULL) {
            $customUser->password = Hash::make($customer['password']);            
        }
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

    public function logout(Request $request) {
        $request->session()->forget('user');
        return redirect('login');
    }
}
