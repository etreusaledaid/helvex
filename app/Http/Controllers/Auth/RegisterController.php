<?php

namespace App\Http\Controllers\Auth;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

//use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/'; //'/admin/home';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'telefono' => 'required|numeric|digits_between:8,15',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $empresa_id = null;
        if ($data['empresa_id'] === 'otra') {
            $data['otraCompania'];
            $empresa_id = DB::table('empresa')->insertGetId(
              ['nombre' => $data['otraCompania'], 'status' => 'review']
            );
        } else {
          $empresa_id = $data['empresa_id'];
        }

        $user = User::create([
            //'empresa_id' => $empresa,
            'name' =>  $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'telefono' => $data['telefono'],
        ]);

        Mail::send('emails.welcome', $data, function($message) use ($data){
            $message->from('no-reply@site.com', "Helvex");
            $message->subject("Bienvenido a la plataforma de Helvex");
            $message->to($data['email']);
        });

        //Mail::to($data['email'])->send(new WelcomeMail($user));

        return $user;
    }

    public function empresas() {
      return response()->json(
        DB::table('empresa')->get()
      );
    }
}
