<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesktopController extends Controller
{
    public function Index()
    {
       return view('Desktop.index');
    }
}
