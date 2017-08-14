<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    // Login/sign-up view
    public function loginShow()
    {
        return view('pages.account.login');
    }

}
