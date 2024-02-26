<?php

namespace App\Http\Controllers;

use App\Models\Commeter;
use App\Models\Like;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;


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
    $user = User::where('email', $donnerUser['email'])->first();

    if ($user && $user->status === 'inactive') {
        return back()->with('error', 'Your account is deleted. Please create new one.');
    }

    if (Auth::attempt($donnerUser)) {
        $user = Auth::user();
        session(['user_id' => $user->id, 'user_name' => $user->name]);
        return redirect()->route('publication.create');
    }

    return back()->with('error', 'Invalid email or password.');
}

    public function logout()
    {
        Auth::logout();
        session()->forget(['user_id', 'user_name']);

        return redirect()->route('accueil');
    }

    public function deactivateAccount()
    {
        $user = User::findOrFail(session('user_id'));
        $user->update(['status' => 'inactive']);
        Auth::logout();
        session()->forget(['user_id', 'user_name']);

        return redirect()->route('accueil')
            ->with('success', 'Account deactivated successfully.');
    }

    public function showSearch()
    {   
        $users = User::where('status', 'active')->get();
        return view('search')->with(['users' => $users]);
    }

    public function searchUsers(Request $request)
    {
        $keyword = $request->input('title_s');
        if ($keyword === '') {
            $users = User::where('status', 'active')->get();
        } else {

            $users = User::where('name', 'like', '%' . $keyword . '%')
                ->where('status', 'active')
                ->get();
        }

        return view('searchresult')->with(['users' => $users, 'keyword' => $keyword]);
    }
}
