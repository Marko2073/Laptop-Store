<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\File;

class AdminController extends OsnovniController
{

    public function admin(Request $request)
    {
        $dateFilter = $request->input('dateFilter');
        $query = DB::table('log')
            ->join('log_type', 'log.log_type_id', '=', 'log_type.id')
            ->join('users', 'log.user_id', '=', 'users.id')
            ->select('log.*', 'log_type.name as log_type', 'users.firstname as name', 'users.lastname as surname')
            ->orderBy('log.created_at', 'desc');

        if ($request->has('reset')) {
            $dateFilter = null;
        }

        if ($dateFilter) {
            $query->whereDate('log.created_at', $dateFilter);
        }

        $logs = $query->paginate(5)->withQueryString();

        return view('pages.admin.index', ['log' => $logs, 'dateFilter' => $dateFilter]);
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
        foreach ($columns as $key => $column){
            if($column == 'brand_id'){
                foreach ($data as $kez => $d){
                    $brand = Brand::find($d->brand_id);
                    $d->brand_id = $brand->name;
                }
            }
            if($column=='model_id'){
                foreach ($data as $kez => $d){
                    $model = DB::table('models')->where('id', $d->model_id)->first();
                    $d->model_id = $model->name;
                }
            }

            if($column=='user_id'){
                foreach ($data as $kez => $d){
                    $user = User::find($d->user_id);
                    $d->user_id = $user->firstname.' '.$user->lastname;
                }
            }

            if($column=='model_specification_id'){
                foreach ($data as $kez => $d){
                    $model = DB::table('model_specification')
                        ->join('models', 'model_specification.model_id', '=', 'models.id')
                        ->select('model_specification.*', 'models.name as model_name')
                        ->where('model_specification.id', $d->model_specification_id)->first();
                    $d->model_specification_id = $model->model_name;
                }
            }

            if($column=='specification_id'){
                foreach ($data as $kez => $d){
                    $specification = DB::table('specifications')->where('id', $d->specification_id)->first();
                    $d->specification_id = $specification->name;
                }
            }
            if($column=='role_id'){
                foreach ($data as $kez => $d){
                    $role = DB::table('roles')->where('id', $d->role_id)->first();
                    $d->role_id = $role->name;
                }
            }
            if($column=='parent_id'){
                foreach ($data as $kez => $d){
                    if($d->parent_id!=null){
                        $parent = DB::table('specifications')->where('id', $d->parent_id)->first();
                        $d->parent_id = $parent->name;
                    }

                }
            }
        }


        return view('pages.admin.table', ['data' => $data, 'columns' => $columns, 'name' => $name]);
    }

}
