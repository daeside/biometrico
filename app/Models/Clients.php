<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \stdClass;
use Carbon\Carbon;

class Clients extends Model
{
    public static function GetClients()
    {
        $data = DB::table('clients')->select('id', 'name', 'alias', 'rfc', 'date_add', 'status')->get();
        $clients = [];

        foreach($data as $key => $value)
        {
            $obj = new stdClass();
            $obj->id = $value->id;
            $obj->nombre = $value->name;
            $obj->alias = $value->alias;
            $obj->rfc = $value->rfc;
            $obj->fechaAlta = Carbon::parse($value->date_add)->format("d/M/Y H:m");
            $obj->status = $value->status;

            array_push($clients, $obj);
        }
        return $clients;
    }

    public static function AddClient(Request $data)
    {
        return $data;
    }
}
