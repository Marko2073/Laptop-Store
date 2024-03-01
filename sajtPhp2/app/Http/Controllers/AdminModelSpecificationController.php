<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminModelSpecificationController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('model_specification');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $data = DB::table('models')->get();
        return view('pages.admin.create', ['columns' => $columns , 'name' => 'model_specification', 'models' => $data]);

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
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;
        DB::table('model_specification')->insert($data);
        return redirect()->route('table', ['name' => 'model_specification']);
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
        $columns = DB::getSchemaBuilder()->getColumnListing('model_specification');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $data = DB::table('models')->get();
        $izbrani = DB::table('model_specification')->where('id', $id)->first();
        $model_specification = DB::table('model_specification')->where('id', $id)->first();
        return view('pages.admin.update', ['columns' => $columns , 'name' => 'model_specification', 'models' => $data, 'model_specification' => $model_specification, 'id' => $id, 'data'=> $izbrani]);

    }

    public function update(Request $request, string $id)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method'])){
            unset($data['_method']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));
        DB::table('model_specification')->where('id', $id)->update($data);
        return redirect()->route('table', ['name' => 'model_specification']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
