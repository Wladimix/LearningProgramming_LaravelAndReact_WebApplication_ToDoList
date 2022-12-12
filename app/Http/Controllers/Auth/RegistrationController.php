<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        $request->session()->put('initials', [
            'name'       => $request->input('name'),
            'surname'    => $request->input('surname'),
            'patronymic' => $request->input('patronymic'),
            'login'      => $request->input('login')
        ]);

        $request->validate([
            'name'                  => 'required|max:50|string',
            'surname'               => 'required|max:50|string',
            'patronymic'            => 'required|max:50|string',
            'login'                 => 'required|max:30|unique:users|regex:/^[a-zA-Z][a-z0-9-_\.]{1,30}$/',
            'password'              => 'required|min:8 |confirmed   |regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
            'password_confirmation' => 'required'
        ]);

        $request->session()->forget('initials');

        $user = new User;
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->patronymic = $request->input('patronymic');
        $user->login = $request->input('login');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);
        return redirect(route('tasks'));
    }
}
