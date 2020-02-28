<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\ResponseController as ResponseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class AuthController extends ResponseController
{
    //create user
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'id_number' => ['required', 'string','unique:users'],
            'age' => 'required',
            'course' => 'required',
            'sex' => 'required',
            'mobile' => ['required','unique:users'],
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input,['api_token' => \Str::random(60)]);

        
        if($user){
            // $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration successfull..";
            return $this->sendResponse($success);
        }
        else{
            $error = "Sorry! Registration is not successfull.";
            return $this->sendError($error, 401); 
        }
        
    }
    
    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        // $credentials = request(['email', 'password' ,'isConfirmed' => 1]);
       
        if(Auth::attempt(['email' => request('email'),'isConfirmed' => 1, 'password' => request('password')])){
        $user = $request->user();
        $user_id = Auth::user()->id;
        $id_number = Auth::user()->id_number;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $course = Auth::user()->course;
        $success =  $user->createToken('token')->accessToken;
        return $this->sendResponse([
            'status' => 'success',
            'bearer_token' =>$success,
            'user_id' => $user_id,
            'id_number' => $id_number,
            'email' => $email,
            'name' => $name,
            'course' =>$course,
            ]);
        }

        $error = "Unauthorized";
        return $this->sendError($error, 401);
       
    }

    //logout
    public function logout(Request $request)
    {
        
        $isUser = $request->user()->token()->revoke();
        if($isUser){
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        }
        else{
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
            
        
    }

    //getuser
    public function getUser(Request $request)
    {
        //$id = $request->user()->id;
        $user = $request->user();
        if($user){
            return $this->sendResponse($user);
        }
        else{
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }
}