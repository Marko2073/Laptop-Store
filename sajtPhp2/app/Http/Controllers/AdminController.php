<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends OsnovniController
{

    public function admin()
    {

        return view('pages.admin.index');
    }
    public function table($name)
    {
        $data = DB::table($name)->paginate(10);
        $columns = DB::getSchemaBuilder()->getColumnListing($name);

        if(in_array('created_at', $columns)){
            $columns = array_diff($columns, ['created_at']);
        }
        if(in_array('updated_at', $columns)){
            $columns = array_diff($columns, ['updated_at']);
        }




        return view('pages.admin.table', ['data' => $data, 'columns' => $columns, 'name' => $name]);
    }

}
