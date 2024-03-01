<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
class LoginController extends OsnovniController
{
    public function index(){
        return view('pages.main.login', );
    }
    public function login(LoginRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $password = md5($password);
        $user = DB::table('users')->where('email', $email)->get()->first();

        if($user->email==$email){

            if($password==$user->password){
                $request->session()->put('user', $user);
                return redirect()->route('home');
            }
        }

        return redirect()->route('login');
    }
    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect()->route('home');
    }

}
