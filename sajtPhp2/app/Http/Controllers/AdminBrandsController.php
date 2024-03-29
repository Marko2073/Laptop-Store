<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBrandsController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('brands');

        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }



        return view('pages.admin.create', ['columns' => $columns, 'name' => 'brands']);
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

            DB::table('brands')->insert($data);

        return redirect()->route('table', ['name' => 'brands']);
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
        $columns = DB::getSchemaBuilder()->getColumnListing('brands');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }


        $data = DB::table('brands')->where('id', $id)->first();
        return view('pages.admin.update', ['data' => $data, 'columns' => $columns, 'name' => 'brands', 'id' => $id]);

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
        if (isset($data['_method'])) {
            unset($data['_method']);
        }

        $columns = DB::getSchemaBuilder()->getColumnListing('brands');
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $bre = DB::table('brands')->where('id', $id)->update($data);
        return redirect()->route('table', ['name' => 'brands']);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

       $models = DB::table('models')->where('brand_id', $id)->get();
         if($models->count() > 0){
              return redirect()->route('table', ['name' => 'brands'])->with('error', 'You can not delete this brand, because it has models');
         }
         else{
              DB::table('brands')->where('id', $id)->delete();
              return redirect()->route('table', ['name' => 'brands']);
         }

    }
}
