<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Login user with custom login
    public function login(Request $request)
    {
        dd($request->all());
    }

}
