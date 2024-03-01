<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPricesController extends Controller
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
        $columns = DB::getSchemaBuilder()->getColumnListing('prices');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $model_specification = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->select('model_specification.*', 'models.name as model_name', 'brands.name as brand_name')
            ->get();


        return view('pages.admin.create', ['columns' => $columns , 'name' => 'prices', 'model_specification' => $model_specification]);
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
        if(isset($data['created_at'])){
            unset($data['created_at']);
        }
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;
        DB::table('prices')->insert($data);
        return redirect()->route('table', ['name' => 'prices']);
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
        $columns = DB::getSchemaBuilder()->getColumnListing('prices');
        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }
        if(in_array('id', $columns)){
            $columns = array_diff($columns, ['id']);
        }
        $model_specification = DB::table('model_specification')
            ->join('models', 'model_specification.model_id', '=', 'models.id')
            ->join('brands', 'models.brand_id', '=', 'brands.id')
            ->select('model_specification.*', 'models.name as model_name', 'brands.name as brand_name')
            ->get();

        $price = DB::table('prices')
            ->where('id', $id)
            ->get()
            ->first();
        return view('pages.admin.update', ['columns' => $columns , 'name' => 'prices', 'model_specification' => $model_specification, 'picture' => $price, 'id' => $id, 'data'=> $price]);
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
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));
        DB::table('prices')
            ->where('id', $id)
            ->update($data);
        return redirect()->route('table', ['name' => 'prices']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
