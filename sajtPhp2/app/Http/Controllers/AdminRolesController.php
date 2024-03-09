<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRolesController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('roles');
        return view('pages.admin.create', ['columns' => $columns, 'name'=>'roles']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NameRequest $request)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;

        DB::table('roles')->insert($data);

        return redirect()->route('table', ['name' => 'roles']);
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
        $columns = DB::getSchemaBuilder()->getColumnListing('roles');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }


        $data = DB::table('roles')->where('id', $id)->first();
        return view('pages.admin.update', ['data' => $data, 'columns' => $columns, 'name' => 'roles', 'id' => $id]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NameRequest $request, string $id)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method'])){
            unset($data['_method']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('roles')->where('id', $id)->update($data);

        return redirect()->route('table', ['name' => 'roles']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = DB::table('users')->where('role_id', $id)->get();
        if(count($user) > 0){
            return redirect()->route('table', ['name' => 'roles'])->with('error', 'You can not delete this role, because it is used by some users');
        }
        else{
            DB::table('roles')->where('id', $id)->delete();
            return redirect()->route('table', ['name' => 'roles']);
        }

    }
}
