<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect()->intended('dashboard');
            } else {
                $newUser = User::firstOrCreate([
                    'email' => $user->email,
                    'google_id' => $user->id,
                ], [
                    'email' => $user->email,
                    'google_id' => $user->id,
                ]);
                $newUser->assignRole(Role::where('name', 'Requester')->first());
                if ($newUser->email == 'guirudj007@gmail.com') {
                    $newUser->assignRole(Role::where('name', 'super-admin')->first());
                }
                Auth::login($newUser);

                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
