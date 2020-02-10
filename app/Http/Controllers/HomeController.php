<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getUsers(){
        $users = \DB::table('users')->get();

        return response()->json($users);

    }

    public function addUser(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'course' => 'required',
            'id_number' => 'required|unique:users',
            'email' => 'required|unique:users',
           ]);

           return User::create([
            'name' => $request['name'],
            'id_number' => $request['id_number'],
            'email' => $request['email'],
            'age' => $request['age'],
            'course' => $request['course'],
            'password' => \Hash::make('12345678')
           ]);
    }

    public function updateUser(Request $request, User $user,$id){

        $user= User::findOrFail($id);

        // $this->validate($request, [
        //     'name' => 'required',
        //     'id_number' => 'required|unique:users',
        //     'email' => 'required|unique:users',
        //    ]);
     
        $user->name = $request->name;
        $user->id_number = $request->id_number;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->course = $request->course;
        $user->isConfirmed = $request->isConfirmed;
        $user->save($request->all());
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
    }
}
