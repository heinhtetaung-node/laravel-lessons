<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;

class UserController extends Controller
{
    //
    public function index() {
        return view('user/index', [
            'username' => 'Ye',
            'users' => [
                [
                    'id' => 1,
                    'name' => 'yE',
                ],
                [
                    'id' => 2,
                    'name' => 'Myat'
                ],
                [
                    'id' => 3,
                    'name' => 'Pg'
                ]
            ],
            'singleuser' => [
                'id' => 2,
                'name' => 'Myat'
            ]
        ]);
    }

    public function create() {
        return view('user/create');
    }

    public function insert(Request $request) {
        $name = $request->name;
        $email = $request->email;
        $address = $request->address;

        $customUser = new CustomUser();
        $customUser->name = $name;
        $customUser->email = $email;
        $customUser->address = $address;
        $res = $customUser->save();
        var_dump($res);
    }
}
