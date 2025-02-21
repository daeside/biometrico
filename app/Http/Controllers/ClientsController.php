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

    public function ViewUpdate($id)
    {
        $cliente = Clients::GetClients($id);
        $data = json_decode(json_encode($cliente[0]));
        return view('Clients.edit', ['data' => $data]);
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
            'start' => 'required|date_format:Y-m-d', 
            'end' => 'required|date_format:Y-m-d'
        ];
        $isValid = ValidatorHelper::ValidateForm($data, $rules);

        if($isValid)
        {
            $success = Clients::AddClient($data);
            return $success;
        }
        return response()->make($isValid, 400);
    }

    public function DeleteProduct($id)
    {
        $success = Clients::DisableProduct($id);
        return $success;
    }
}
