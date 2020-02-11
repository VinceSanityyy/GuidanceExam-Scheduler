<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class ResponseController extends Controller
{
    public function sendResponse($response)
    {
    //    $response = \Response::json(['status' => 'success',$response]);
         return response()->json($response, 200);
    //    $response = \Response::json(array_merge(['status' => 'success',$response]));

    //    return $response;
    }


    public function sendError($error, $code = 404)
    {
    	$response = [
            'error' => $error,
        ];
        return response()->json($response, $code);
    }
}