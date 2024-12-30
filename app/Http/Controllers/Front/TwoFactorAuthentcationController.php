<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthentcationController extends Controller
{

    public function index()
    {
        $user = auth('client-web')->user();
        return view('front.two-factor-auth', compact('user'));
    }
}
