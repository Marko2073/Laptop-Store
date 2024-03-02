<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUsersController extends OsnovniController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $columns = DB::getSchemaBuilder()->getColumnListing('users');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $roles = Role::all();
        return view('pages.admin.create', ['columns' => $columns , 'name' => 'users', 'roles' => $roles]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {

        if($request->hasFile('path')){
            $this->cutImage($request);
            $data = $request->input();
            $image = $request->file('path')->getClientOriginalName();
            $data['path'] = $image;
        }
        else{
            $data = $request->input();
            $data['path'] = 'avatarUser.jpg';
        }

        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $data['password'] =md5($data['password']);
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;
        DB::table('users')->insert($data);
        return redirect()->route('table', ['name' => 'users']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing('users');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $roles = Role::all();
        $user = DB::table('users')->where('id', $id)->first();
        return view('pages.admin.update', ['columns' => $columns , 'name' => 'users', 'data' => $user, 'roles' => $roles , 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        if($request->hasFile('path')){
            $this->cutImage($request);
            $data = $request->input();
            $image = $request->file('path')->getClientOriginalName();
            $data['path'] = $image;
        }
        else{
            $data = $request->input();
        }
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method'])){
            unset($data['_method']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));
        DB::table('users')->where('id', $id)->update($data);
        return redirect()->route('table', ['name' => 'users']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('table', ['name' => 'users']);
    }
}
