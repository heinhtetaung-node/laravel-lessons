<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CustomUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // CustomUser::insert([
        //     'name' => Str::random(10),
        //     'nickname' => Str::random(10),
        //     'address' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => Hash::make('password'),
        // ]); // without created updatad


        // $customUser = new CustomUser();
        // $customUser->name = Str::random(10);
        // $customUser->nickname = Str::random(10);
        // $customUser->address = Str::random(10);
        // $customUser->email = Str::random(10).'@gmail.com';
        // $customUser->password = Hash::make('password');
        // $customUser->save();

        CustomUser::factory()->count(50)->create();
    }
}
