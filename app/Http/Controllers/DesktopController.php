<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use App\Http\Requests;


class DesktopController extends Controller
{
    public function Index()
    {
        //echo 1;
        $users = DB::select('select * from test');
        var_dump($users);
       return null;//view('Desktop.index');
    }
}
