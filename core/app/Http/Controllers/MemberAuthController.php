<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MemberAuthController extends Controller
{
    public function postLogin(Request $request)
    {

        if (Auth::guard('member')->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])
        ) {

            // Authentication passed...
            return redirect('/');

        }

        $request->session()->flash('message', 'Login incorrect!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        session()->flash('message', 'Just Logged Out!');
        /*return 'LOG OUT';*/
        return redirect()->route('user-login');
    }
}
