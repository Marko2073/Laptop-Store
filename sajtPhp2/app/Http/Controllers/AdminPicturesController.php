<?php

namespace App\Http\Controllers;

use App\Http\Requests\PicturesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPicturesController extends OsnovniController
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
        $columns = DB::getSchemaBuilder()->getColumnListing('pictures');
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


        return view('pages.admin.create', ['columns' => $columns , 'name' => 'pictures', 'model_specification' => $model_specification]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PicturesRequest $request)
    {
        $this->cutImage($request);
        $data = $request->input();
        $image = $request->file('path')->getClientOriginalName();

        if(isset($data['_token'])){
            unset($data['_token']);
        }
        $data['path'] = $image;
        $data['created_at'] = date('Y-m-d H:i:s', strtotime('now'));
        $data['updated_at'] = null;
        DB::table('pictures')->insert($data);
        return redirect()->route('table', ['name' => 'pictures']);



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

        $columns = DB::getSchemaBuilder()->getColumnListing('pictures');
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

        $picture = DB::table('pictures')->where('id', $id)->get()->first();
        return view('pages.admin.update', ['columns' => $columns , 'name' => 'pictures', 'model_specification' => $model_specification, 'picture' => $picture, 'id' => $id]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PicturesRequest $request, string $id)
    {
        $this->cutImage($request);
        $data = $request->input();
        $image = $request->file('path')->getClientOriginalName();

        if(isset($data['_token'])){
            unset($data['_token']);
        }
        if(isset($data['_method'])){
            unset($data['_method']);
        }
        $data['path'] = $image;
        $data['updated_at'] = date('Y-m-d H:i:s', strtotime('now'));
        DB::table('pictures')->where('id', $id)->update($data);
        return redirect()->route('table', ['name' => 'pictures']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pictures')->where('id', $id)->delete();
        return redirect()->route('table', ['name' => 'pictures']);
    }
}
