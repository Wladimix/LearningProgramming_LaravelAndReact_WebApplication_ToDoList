<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\PasswordVerification;

class LoginController extends Controller
{
    public function authentication(Request $request)
    {
        $request->session()->put('login', $request->input('login'));

        $passwordFromTheDatabase = DB::table('users')->where('login', $request->input('login'))->value('password');
        $passwordFromTheForm     = $request->input('password');
        $passwordVerification    = false;

        if (Hash::check($passwordFromTheForm, $passwordFromTheDatabase)) {
            $passwordVerification = true;
        }

        $formFields = $request->validate([
            'login'    => ['required', 'string', 'exists:users'],
            'password' => ['required', 'string', new PasswordVerification($passwordVerification)]
        ]);

        $request->session()->forget('login');

        Auth::attempt($formFields, $request->boolean('remember-me'));
        $request->session()->regenerate();
        return redirect(route('tasks'));

    }
}
