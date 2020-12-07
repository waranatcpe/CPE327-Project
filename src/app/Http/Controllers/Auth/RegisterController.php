<?php
namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use Config;
use App;

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
    protected $redirectTo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = "/".Config::get('app.locale')."/home";
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    function valid_citizen_id($personID)
    {
        if (strlen($personID) != 13) {
            return false;
        }
        $rev = strrev($personID); 
        $total = 0;
        for($i=1;$i<13;$i++) 
        {
            $mul = $i +1;
            $count = $rev[$i]*$mul; 
            $total = $total + $count; 
        }
        $mod = $total % 11; 
        $sub = 11 - $mod; 
        $check_digit = $sub % 10; 
        if($rev[0] == $check_digit)  
            return true;
        else
            return false;
    }

    protected function validator(array $data)
    {
        $citizen = $this->valid_citizen_id($data['username']);
        return Validator::make($data, [
            'prefix' => ['required', Rule::In(['นาย', 'นางสาว','Mr.','Ms.'])],
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'username' => 'required|string|max:13|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
        $random_session = env('APP_YEAR').date('dmis')."0".rand(000,999);
            return User::create([
                'prefix' => $data['prefix'],
                'name' => $data['name'],
                'lastname' => $data['lastname'], 
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'type' => User::STUDENT_TYPE,
            ]);        
    }
}