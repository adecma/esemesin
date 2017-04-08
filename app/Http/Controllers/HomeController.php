<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6|',
                'currentUrl' => 'required|url',
            ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect($request->input('currentUrl'));
    }

    public function changeProfile(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|min:6',
                'email' => 'required|email',
                'currentUrl' => 'required|url',
            ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect($request->input('currentUrl'));
    }
}
