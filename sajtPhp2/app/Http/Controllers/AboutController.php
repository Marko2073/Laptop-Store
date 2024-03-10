<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends OsnovniController
{

    public function index(){
        return view('pages.main.about');
    }
}
