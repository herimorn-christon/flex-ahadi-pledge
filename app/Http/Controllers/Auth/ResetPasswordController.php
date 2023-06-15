<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
            'resetUrl' => $request->resetUrl // Add the $resetUrl variable
        ]);
    }

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
        $this->guard()->login($user);
    }

    public function reset(Request $request)
    {
        $email =$request->email;
        $user = User::where('email', $email)->first();
    
        if (!$user) {
            return "User with email '$email' not found!";
        }
    
        $newPassword = $request->password;
        $user->password = Hash::make($newPassword);
        $user->save();
    
        $notification=array(
            'message'=>'password reseted SuccessFully',
            'alert-type'=>'success'
         );
          return redirect()->back()->with($notification);
        // $request->validate($this->rules(), $this->validationErrorMessages());

        // $response = $this->broker()->reset(
        //     $this->credentials($request),
        //     function ($user, $password) {
        //         $this->resetPassword($user, $password);
        //     }
        // );

        // return $response == Password::PASSWORD_RESET
        //     ? redirect($this->redirectPath())->with('status', __($response))
        //     : back()->withErrors(['email' => __($response)]);
    }
}