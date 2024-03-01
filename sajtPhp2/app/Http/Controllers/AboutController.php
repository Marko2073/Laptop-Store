<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends OsnovniController
{

    public function index(){
        $this->data["korisnici"] = DB::table('korisnik')->get();
        return view('pages.main.about', ["data" => $this->data]);
    }
}
