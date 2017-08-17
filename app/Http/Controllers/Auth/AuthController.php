<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    // New user sign-up
    public function join(Request $request)
    {
        $validation = Validator::make($request->all(), User::$join_rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages(), 'join_errors');
        }
        // Check if a user with information already exists
        if ($this->checkAvailability($request->get('username'))->getData()) {
            return redirect()->back()->withInput()->withErrors('Username already exists.', 'join_errors');

        } else if ($this->checkAvailability($request->get('email'))->getData()) {
            return redirect()->back()->withInput()->withErrors('Email already exists.', 'join_errors');
        }

        $settings = Settings::create([
            'skills_level' => $request->get('skills_level')
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'username_last_changed' => date("Y-m-d H:i:s"),
            'password' => Hash::make($request->get('password')),
            'settings_id' => $settings->id,
        ]);

        return view('pages.account.login');
    }

    // Login user with custom login
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), User::$login_rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation->messages(), 'login_errors');
        }

        $user = User::where('username', $request->get('login'))->orWhere('email', $request->get('login'))->first();

        if ($user) {
            if (Hash::check($request->get('password'), $user->password)) {
                Auth::login($user, true);

                return redirect()->route('home');
            }
        }
        return redirect()->back()->withInput()->withErrors("Invalid username or password", 'login_errors');
    }

    // Logout current user
    public function logout()
    {
        Auth::logout();

        return view('pages.account.logout');
    }

    // Checks if a user exists with username or email
    public function checkAvailability($data)
    {
        return response()->json(User::where('username', 'LIKE', '%' . $data . '%')->orWhere('email', $data)->exists());
    }

    // Redirect to Google login
    public function redirectToGoogle()
    {
        return $this->socialite()->redirect();
    }

    // Google auth callback
    public function googleCallback()
    {
        $googleUser = $this->socialite()->user();
        $user = User::where('email', $googleUser->email)->first();

        // Create new user from Google if doesn't exist
        if ($user === NULL) {
            $settings = Settings::create([
                'skills_level' => "Beginner"
            ]);

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'profile_img' => substr($googleUser->avatar, 0, -2) . "100",
                'username' => $googleUser->name,
                'username_last_changed' => date("Y-m-d H:i:s"),
                'settings_id' => $settings->id,
            ]);
        }
        Auth::login($user, true);

        return redirect()->route('home');
    }

    private function socialite()
    {
        return \Socialite::driver('google');
    }

}
