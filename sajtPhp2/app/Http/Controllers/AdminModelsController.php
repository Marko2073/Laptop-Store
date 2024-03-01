<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminModelsController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('models');

        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }

        $brands = DB::table('brands')->get();


        return view('pages.admin.create', ['columns' => $columns, 'name' => 'models', 'brands' => $brands]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $columns = DB::getSchemaBuilder()->getColumnListing('models');
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;

        DB::table('models')->insert($data);

        return redirect()->route('table', ['name' => 'models']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing('models');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }

        $data = DB::table('models')->where('id', $id)->get();
        $brands = DB::table('brands')->get();


        return view('pages.admin.update', ['columns' => $columns, 'name' => 'models',  'id' => $id, 'data' => $data[0], 'brands' => $brands]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method'])){
            unset($data['_method']);
        }
        $columns = DB::getSchemaBuilder()->getColumnListing('models');
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('models')->where('id', $id)->update($data);

        return redirect()->route('table', ['name' => 'models']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
