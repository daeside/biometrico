<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesktopController extends Controller
{
    public function index()
    {
       return view('Desktop.index');
    }

    public function Error()
    {
        return view('Desktop.error');
    }
}
