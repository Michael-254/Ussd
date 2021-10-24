<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Sparors\Ussd\Facades\Ussd;
use Sparors\Ussd\Machine;
use App\Http\Ussd\States\Welcome;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UssdController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->input('text');
        $session_id = $request->input('sessionId');
        $phone_number = $request->input('phoneNumber');
        $service_code = $request->input('serviceCode');
        $network_code = $request->input('networkCode');
        Session::put('phone_number', $phone_number);

        $user = User::wherePhoneNumber($phone_number)->first();
        if ($user == null) {
            User::create(['phone_number' => $phone_number]);
        }

        $level = explode("*", $text);
        $ussd = (new Machine())->setSessionId($session_id)
            ->setInput(end($level))
            ->setInitialState(Welcome::class);

        return response($ussd->run()['message'])->header('Content-Type', 'text/plain');
    }
}
