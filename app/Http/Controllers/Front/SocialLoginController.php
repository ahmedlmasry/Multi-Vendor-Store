<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)
            //->scopes(['https://www.googleapis.com/auth/drive.file'])
            ->redirect();
    }

    public function callback($provider)
    {
        try {
            $provider_user = Socialite::driver($provider)->user();
//            dd($provider_user);

            $user = \App\Models\Client::where([
                'provider' => $provider,
                'provider_id' => $provider_user->id
            ])->first();

            if (!$user) {
                $user = \App\Models\Client::create([
                    'name' => $provider_user->name,
                    'email' => $provider_user->email,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $provider_user->id,
                    'provider_token' => $provider_user->token,
                ]);
            }
            Auth::login($user);
            return redirect()->route('home');

        } catch (Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }
}
