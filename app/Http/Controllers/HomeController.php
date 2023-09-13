<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasswordDiary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $diary = PasswordDiary::get();
        return view('home',compact('diary'));
    }

    public function addpassword(Request $request)
    {
        $hasla = PasswordDiary::create($request->all());
        $hasla->token = Hash::make($request->token);
        $hasla->password = Crypt::encrypt($request->password); //AES Encryption
        $hasla->save();
        $diary = PasswordDiary::get();
        return view('home',compact('diary'));
    }

    public function showpassword(Request $request)
    {
        $diary = PasswordDiary::get();
        if(Hash::check($request->password,Auth::user()->password))
        {
        return view('home2',compact('diary'));
        } else return view('home',compact('diary')); 
    }
}
