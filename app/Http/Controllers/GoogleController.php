<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $user = User::firstOrCreate([
                'email' => $user->email,
            ], [
                'google_id' => $user->id,
                'last_name' => $user->displayName,
            ]);

            Auth::login($user);

            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
