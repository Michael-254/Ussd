<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Evans\BulkSms\BulkSmsService;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bulkSms = new BulkSmsService('username', 'password', 'http://bulksms.vsms.net:5567');
        $request = $bulkSms->sendMessage('254703780985', 'Hello there!');
        
        dd($request);
    }
}
