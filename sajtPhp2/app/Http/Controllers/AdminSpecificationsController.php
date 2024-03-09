<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSpecificationsController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('specifications');

        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        if(in_array('parent_id', $columns)){
            $parentElements = DB::table('specifications')->where('parent_id', null)->get();
        }



        return view('pages.admin.create', ['columns' => $columns, 'name' => 'specifications', 'parentElements' => $parentElements]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecificationsRequest $request)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }

        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;

        DB::table('specifications')->insert($data);

        return redirect()->route('table', ['name' => 'specifications']);
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
        $columns = DB::getSchemaBuilder()->getColumnListing('specifications');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        if(in_array('parent_id', $columns)){
            $parentElements = DB::table('specifications')->where('parent_id', null)->get();
        }

        $specification = DB::table('specifications')->where('id', $id)->get()->first();

        return view('pages.admin.update', ['columns' => $columns, 'name' => 'specifications', 'data' => $specification, 'parentElements' => $parentElements , 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecificationsRequest $request, string $id)
    {
        $data = $request->input();
        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method']))
        {
            unset($data['_method']);
        }

        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('specifications')->where('id', $id)->update($data);

        return redirect()->route('table', ['name' => 'specifications']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $specifications_individualy = DB::table('specifications_individually')->where('specification_id', $id)->get();
        if(count($specifications_individualy) > 0){
            return redirect()->route('table', ['name' => 'specifications'])->with('error', 'This specification is used in some products');
        }
        else{
            DB::table('specifications')->where('id', $id)->delete();
            return redirect()->route('table', ['name' => 'specifications']);
        }

    }
}
