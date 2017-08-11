<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Login/sign-up view
    public function loginShow()
    {
        return view('pages.account.login');
    }

    // New user sign-up
    public function join(Request $request)
    {
        dd($request->all());
    }

}
