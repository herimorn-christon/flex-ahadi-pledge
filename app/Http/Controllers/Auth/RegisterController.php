<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserSubscriptions;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
    protected $redirectTo = 'member/dashboard';

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
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'jumuiya' => ['required'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'jumuiya' => $data['jumuiya'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function apistore(Request $request)
    {
        


        $request->validate(
            [
                'fname' => ['required', 'string', 'max:255'],
                'mname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:13'],
                'jumuiya' => ['required'],
                'date_of_birth' => ['required'],
                'gender' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]
        );

        

       $user = User::create([
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'jumuiya' => $request['jumuiya'],
            'password' => Hash::make($request['password']),
            'place_of_birth' => $request['place_of_birth'],
            'martial_status' => $request['martial_status'],
            'marriage_type' => $request['marriage_type'],
            'marriage_date' => $request['marriage_date'],
            'partner_name' => $request['partner_name'],
            'place_of_marriage' => $request['place_of_marriage'],
            'old_usharika' => $request['old_usharika'],
            'fellowship_name' => $request['fellowship_name'],
            'neighbour_msharika_name' => $request['neighbour_msharika_name'],
            'neighbour_msharika_phone' => $request['neighbour_msharika_phone'],
            'deacon_name' => $request['deacon_name'],
            'deacon_phone' => $request['deacon_phone'],
            'occupation' => $request['occupation'],
            'place_of_work' => $request['place_of_work'],
            'proffession' => $request['proffession'],
            'can_volunteer' => $request['can_volunteer'],
            'baptized' => $request['baptized'],
            'baptization_date' => $request['baptization_date'],
            'kipaimara' => $request['kipaimara'],
            'kipaimara_date' => $request['kipaimara_date'],
            'sacramenti_meza_bwana' => $request['sacramenti_meza_bwana']
        ]);

        foreach ($request->selected_subs as $sub) {
            UserSubscriptions::create([
                'user_id' => $user->id,
                'sub_id' => $sub
            ]);
        }

        return response()->json(['success' => true], 201);
    }
}
