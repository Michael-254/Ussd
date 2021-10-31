<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    use IssueTokenTrait;

    public function login(Request $request)
    {
    	$request->validate([
            'key' => 'required|string',
            'secret' => 'required|string'
        ]);

        $client = Client::whereId($request->key)->whereSecret($request->secret)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 500);
        }
		
        $token = $this->issueToken($request, 'password');
        $data = json_decode($token->getContent());
    
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function refresh(Request $request){
    	$this->validate($request, [
    		'refresh_token' => 'required'
    	]);

    	return $this->issueToken($request, 'refresh_token');

    }
}
