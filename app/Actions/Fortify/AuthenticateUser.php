<?php

namespace App\Actions\Fortify;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public function authenticate($request)
    {

        $username = $request->post( config('fortify.username') );
        $password = $request->post('password');

        $client = Client::where('name',$username)
            ->orWhere('email',$username)
            ->orWhere('phone',$username)
            ->first();

        if ($client && Hash::check($password, $client->password)) {
            return $client;
        }

        return false;

    }
}
