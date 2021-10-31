<?php 

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait{

	public function issueToken(Request $request, $grantType, $scope = ""){

		$params = [
    		'username' => 'admin@admin.com',
    		'password' => 'Admin123',
    		'grant_type' => $grantType,
    		'client_id' => $request->key,
    		'client_secret' => $request->secret,    		
    		'scope' => $scope
    	];

    	$request->request->add($params);

    	$proxy = Request::create('oauth/token', 'POST');

    	return Route::dispatch($proxy);

	}

}