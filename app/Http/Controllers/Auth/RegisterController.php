<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Flash;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_number' => ['required', 'string','unique:users'],
            'age' => 'required',
            'course' => 'required',
            'sex' => 'required',
            'yearlevel' => 'required',
            'mobile' => ['required','unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        // dd($data['yearlevel']);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'id_number' => $data['id_number'],
            'age' => $data['age'],
            'course' => $data['course'],
            'isConfirmed' => 0,
            'password' => Hash::make($data['password']),
            'sex' =>$data['sex'],
            'mobile' =>$data['mobile'],
            'yearlevel' =>$data['yearlevel'],
            'api_token' => \Str::random(60),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        // Auth::logout($user);
        // return redirect('/welcome')->with('message', 'Account Successfully Registered');
        abort(403, 'Wait for the admin to confirm your account for mobile use.');
        // $request->session()->flash('alert-success', 'Registration successful');
    }
}
