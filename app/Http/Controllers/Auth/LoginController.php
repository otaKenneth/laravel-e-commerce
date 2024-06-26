<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Exception;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect('/');
            } else {
                $finduser = User::where('email', $user->email)->first();

                if ($finduser) {
                    $finduser->google_id = $user->id;
                    $finduser->update();

                    Auth::login($finduser);
                } else {
                    $newUser = User::create([
                        'google_id' => $user->id,
                        'first_name' => $user->user['given_name'],
                        'last_name' => $user->user['family_name'],
                        'email' => $user->email,
                        'password' => Hash::make(Str::random(16)),
                        'email_verified_at' => now(),
                        'status' => 1
                    ]);

                    Auth::login($newUser);
                }

                return redirect('/');
            }
        } catch (\Throwable $th) {
            return redirect('/user/login-register')->withErrors([
                'error_message' => $th->getMessage()
            ]);
        }
    }
}
