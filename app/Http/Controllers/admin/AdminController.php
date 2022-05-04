<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;

class AdminController extends Controller
{
    function check(Request $request)
    {
        //validation
        $request->validate([
            'username' => 'required|exists:admins,email',
            'password' => 'required|min:5|max:30',
        ], [
            'username.exists' => 'Incorrect username'
        ]);

        if ($this->attemptLogin($request)) {
            return $this->successfulLogin($request);
        }
        return $this->failedLogin($request);
    }

    protected function attemptLogin(Request $request)
    {
        //Try with email AND username fields
        if (
            Auth::guard('admin')->attempt([
                'mobile' => $request['username'],
                'password' => $request['password']
            ], $request->has('remember'))
            || Auth::guard('admin')->attempt([
                'email' => $request['username'],
                'password' => $request['password']
            ], $request->has('remember'))
        ) {
            return true;
        }
        return false;
    }

    protected function successfulLogin(Request $request)
    {
        // return redirect()->route('/home');
        return redirect()->route('admin.home');
    }

    protected function failedLogin(Request $request)
    {
        return redirect()->back()->withErrors(['password' => 'Incorrect password']);
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }
}
