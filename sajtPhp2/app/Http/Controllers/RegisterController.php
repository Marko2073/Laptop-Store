<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends OsnovniController
{
    public function index(){
        return view('pages.main.register');
    }
    public function store(RegisterRequest $request){

        if($request->password != $request->passwordc){
            return back()->with('error', 'Password does not match');
        }
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $path = 'avatarUser.png';
        $city = $request->city;
        $password = md5($request->password);
        $role_id = 2;




        $user = new User();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->phone = $phone;
        $user->address = $address;
        $user->path = $path;
        $user->city = $city;
        $user->password = $password;
        $user->role_id = $role_id;
        $user->save();

        DB::table('log')->insert([
            'log_type_id' => 2,
            'user_id' => $user->id,
            'description' => 'User ' . $user->firstname . ' ' . $user->lastname . ' has been registered.',
            'created_at' => date('Y-m-d H:i:s')
        ]);


        return redirect()->route('login');
    }

    public function updateuser(UpdateUserRequest $request){

        $user = User::find(session()->get('user')->id);
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->save();
        return redirect()->route('profile');
    }
    public function updatepicture(ImageRequest $request){
        $user = User::find(session()->get('user')->id);
            $this->cutImage($request);
            $image = $request->file('path')->getClientOriginalName();
            $user->path = $image;
            $user->save();

        return redirect()->route('profile');
    }


}
