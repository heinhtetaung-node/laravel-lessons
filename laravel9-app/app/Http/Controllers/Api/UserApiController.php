<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomUser;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    //
    public function getDatas(Request $request) {
        $para = ['orderBy' => 'id', 'order' => 'desc'];
        if ($request->has('orderBy')) {
            $para['orderBy'] = $request->input('orderBy');
        }
        if ($request->has('order')) {
            $para['order'] = $request->input('order');
        }
        $name = '';        
        if ($request->has('name')) {
            $name = $request->name;
        }
        $nickname = '';        
        if ($request->has('nickname')) {
            $nickname = $request->nickname;
        }
        $address = '';        
        if ($request->has('address')) {
            $address = $request->address;
        }
        $users = CustomUser::where(function($query) use ($name, $nickname, $address) {
                                        if ($name != '') {
                                            $query->where('name', 'like', '%'.$name.'%');  
                                        }
                                        if ($nickname != '') {                                            
                                            $query->orWhere('nickname', 'like', '%'.$nickname.'%');
                                        }
                                    });

        $users = $users->where('address', 'like', '%'.$address.'%');

        if ($request->has('email') && $request->get('email') != '') {
            $users = CustomUser::where('email', '=', $request->get('email'));
        }

        $users = $users->orderBy($para['orderBy'], $para['order'])->paginate(5)->withQueryString();
        return $users;
    }
    public function insertDatas(UserPostRequest $request) {
        $customer = $request->safe()->only(['name', 'email', 'address', 'nickname', 'id', 'password']);
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
        if ($res) {
            return ['success' => true];
        }
        return ['success' => false];
    }
    public function deleteData($id) {
        $user = CustomUser::findOrFail($id);
        $res = $user->delete();
        if ($res) {
            return ['success' => true];
        }
        return ['success' => false];
    }
}
