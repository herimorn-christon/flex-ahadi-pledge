<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = 'member/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:13'],
            'jumuiya' => ['required'],
            'church_id' => ['required'],
            'date_of_birth' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $minBirthYear = now()->subYears(18)->format('Y');
                    $submittedBirthYear = date('Y', strtotime($value));

                    if ($submittedBirthYear > $minBirthYear) {
                        return $fail('You must be at least 18 years old.');
                    }
                },
            ],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'mname' => $data['mname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'church_id' => $data['church_id'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'jumuiya' => $data['jumuiya'],
            'password' => Hash::make($data['password']),
        ]);

        $roleName = 'member';
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            $role = Role::create(['name' => $roleName]);
        }

        $user->assignRole($role);

        return $user;
    }
}
