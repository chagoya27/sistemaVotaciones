<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserAuthController extends Controller
{
    public function index (){
        return view('login');
    }

    public function login (Request $request){

        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'password' => ['required'],
        ]);

        $user = User::where('user_name',$request->user_name)->first();
        if (!$user || !Hash::check($request->password,$user->password)){
            return back()->withErrors(['msg' => 'Credenciales incorrectas']);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function register (){
        return view('register');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => ['required'],
            'last_name1' => ['required'],
            'last_name2' => ['required'],
            'user_name' => ['required'],
            'password' => ['required'],
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);
        
        return redirect()->route('index');

    }
}
