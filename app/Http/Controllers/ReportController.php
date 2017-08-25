<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Validator;

// Manages user reporting
class ReportController extends Controller
{
    public function report(Request $request)
    {
        $validation = Validator::make($request->all(), Report::$report_rules);
        if ($validation->fails()) {
            return redirect()->back();
        }

        Report::create([
            'reporter_id' => Auth::id(),
            'user_id' => Crypt::decrypt($request->get('user_id')),
            'reason' => $request->get('reason')
        ]);

        $username = Crypt::decrypt($request->get('username'));

        return redirect()->route('profile', ['username' => $username])->with('account-message', 'Thank you for notifying us about ' . $username . '.');
    }

}
