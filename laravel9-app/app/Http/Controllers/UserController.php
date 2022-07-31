<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomUser;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Hash;

use GuzzleHttp\Client;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;

use GuzzleHttp\RequestOptions;

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
        // $users = CustomUser::where('name', 'like', '%'.$name.'%')
        //             ->orWhere('nickname', 'like', '%'.$nickname.'%')
        //             ->where('address', 'like', '%'.$address.'%')
        //             // ->where('email', '=', $email)
        //             ->orderBy($para['orderBy'], $para['order']);
        //             // ->paginate(50)
        //             // ->withQueryString();                 


        // $users = CustomUser::where(function($query) use ($name, $nickname, $address) {
        //                         $query->where('name', 'like', '%'.$name.'%')
        //                               ->orWhere('nickname', 'like', '%'.$nickname.'%');
        //                     })
        //                     ->where('address', 'like', '%'.$address.'%')
        //                     ->orderBy($para['orderBy'], $para['order'])
        //                     ->paginate(50)
        //                     ->withQueryString();
        
        // $users = CustomUser::where(function($query) use ($name, $nickname, $address) {
        //                                 if ($name != '') {
        //                                     $query->where('name', 'like', '%'.$name.'%');  
        //                                 }
        //                                 if ($nickname != '') {
        //                                     if ($name != '') {
        //                                         $query->orWhere('nickname', 'like', '%'.$nickname.'%');
        //                                     } else {
        //                                         $query->where('nickname', 'like', '%'.$nickname.'%');
        //                                     }
        //                                 }
        //                             })
        //                             ->where('address', 'like', '%'.$address.'%')
        //                             ->orderBy($para['orderBy'], $para['order'])
        //                             ->paginate(50)
        //                             ->withQueryString();

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

        // $users = CustomUser::orderBy($para['orderBy'], $para['order'])->paginate(50)->withQueryString();        
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

        // send email to user
        $BASE_URL = "https://gy2ple.api.infobip.com";
        $API_KEY = "1f5782599be8e54f040d6223e9081080-403f9346-3ce6-4c2b-97aa-651c9de3ba45";
        
        $client = new Client([
            'base_uri' => $BASE_URL,
            'headers' => [
                'Authorization' => "App $API_KEY",
                'Content-Type' => 'multipart/form-data',
                'Accept' => 'application/json',
            ]
        ]);
        
        $response = $client->request(
            'POST',
            'email/2/send',
            [
                RequestOptions::MULTIPART => [
                    ['name' => 'from', 'contents' => "heinhtetaung.itlife@selfserviceib.com"],
                    ['name' => 'to', 'contents' => $customUser->email],
                    ['name' => 'subject', 'contents' => 'Welcome'],
                    ['name' => 'text', 'contents' => 'Welcome to our website, Your account is successfully created'],
                    // example how to attach a file
                    /*[
                        'Content-type' => 'multipart/form-data',
                        'name' => 'file',
                        'contents' => fopen('/tmp/testfile.pdf', 'r'),
                        'filename' => 'testfile.pdf',
                    ],*/
                ],
            ]
        );


        $SENDER = "InfoSMS";
        $RECIPIENT = "66811766233";
        $MESSAGE_TEXT = "Welcome to our website, Your account is successfully created";
        
        $configuration = (new Configuration())
            ->setHost($BASE_URL)
            ->setApiKeyPrefix('Authorization', 'App')
            ->setApiKey('Authorization', $API_KEY);
        
        $client = new Client();
        
        $sendSmsApi = new SendSMSApi($client, $configuration);
        $destination = (new SmsDestination())->setTo($RECIPIENT);
        $message = (new SmsTextualMessage())
            ->setFrom($SENDER)
            ->setText($MESSAGE_TEXT)
            ->setDestinations([$destination]);
        
        $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);
        
        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);            
        } catch (Throwable $apiException) {
            echo("HTTP Code: " . $apiException->getCode() . "\n"); 
            exit;
        }

        // var_dump(json_decode($response->getBody())); 
        // echo "<br>";
        // var_dump($smsResponse); 
        // exit;
        
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
