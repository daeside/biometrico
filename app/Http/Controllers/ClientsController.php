<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clients;
use \App\Helpers\ValidatorHelper;

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
        $rules = [
            'name' => 'required', 
            'alias' => 'required', 
            'rfc' => 'required', 
            'start' => 'required', 
            'end' => 'required'
        ];
        $isValid = ValidatorHelper::ValidateForm($data, $rules);
        /*
        if($isValid)
        {
            $success = Clients::AddClient($data);
            return $success;
        }
        return response()->make($isValid, 400);
        */
        return $isValid;
    }
}
