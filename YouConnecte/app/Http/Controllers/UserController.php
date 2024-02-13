<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        return view("login");
    }
    public function showAccount()
    {
        return view("account");
    }



    public function creatAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }


        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Session::flash('success', 'Registration successful. Please login.');

        return redirect()->route('home');
    }




    public function login(Request $request)
    {
        $donnerUser = $request->only('email', 'password');
        if (Auth::attempt($donnerUser)) {
            $user = Auth::user();
            session(['user_id' => $user->id, 'user_name' => $user->name]);
                return redirect()->route('form');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    public function logout()
    {
        Auth::logout();
        session()->forget(['user_id', 'user_name']);

        return redirect()->route('home');
    }
}
