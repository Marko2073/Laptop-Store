<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

        if($user!=null){


            if($password==$user->password){
                $request->session()->put('user', $user);
                DB::table('log')->insert([
                    'user_id' => $user->id,
                    'log_type_id' => 1,
                    'description' => 'User ' . $user->firstname . ' ' . $user->lastname . ' has logged in.',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                return redirect()->route('home');
            }
        }
        else{
            return redirect()->route('login')->with('error', 'Wrong email or password');
        }


        return redirect()->route('login');
    }
    public function logout(Request $request){
        $user = $request->session()->get('user')->id;
        $about = $request->session()->get('user')->firstname . ' ' . $request->session()->get('user')->lastname;
        $request->session()->forget('user');
        DB::table('log')->insert([
            'user_id' => $user,
            'log_type_id' => 3,
            'description' => 'User ' .$about . ' has logged out.',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('home');
    }

}
