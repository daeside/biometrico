<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use \stdClass;
use Carbon\Carbon;

class Clients extends Model
{
    public static function GetClients()
    {
        $data = DB::table('clients')->select('id', 'name', 'alias', 'rfc', 'date_add', 'status', 'vigency_date_end')->get();
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
            $obj->vigency = Carbon::parse($value->vigency_date_end)->format("d/M/Y");

            array_push($clients, $obj);
        }
        return $clients;
    }

    public static function AddClient($data)
    {
        $insert = DB::table('clients')->insert([
            'name' => $data->name, 
            'alias' => $data->alias,
            'rfc' => $data->rfc,
            'vigency_date_start' => Carbon::parse($data->start)->format("Y-m-d"),
            'vigency_date_end' => Carbon::parse($data->end)->format("Y-m-d")
        ]);
        return $insert;
    }
}
