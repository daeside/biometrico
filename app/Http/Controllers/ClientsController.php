<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clients;

class ClientsController extends Controller
{
    public function ViewClients()
    {
        return view('Clients.view');
    }

    public function GetClients()
    {
        $clients = Clients::GetClients();
        return $clients;
    }

    public function ViewAddClient()
    {
        return view('Clients.add');
    }

    public function AddClient(Request $data)
    {
        return $data;
    }
}
