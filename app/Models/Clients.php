<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use \stdClass;
use Carbon\Carbon;

class Clients extends Model
{
    public static function GetClients($id = 0)
    {
        $condition = $id == 0 ? '<>' : '=';
        $data = DB::table('clients')
                ->select('id', 'name', 'alias', 'rfc', 'date_add', 'status', 'vigency_date_start', 'vigency_date_end')
                ->where([['status', '=', true], ['id', $condition, $id]])
                ->get();
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
            $obj->start = Carbon::parse($value->vigency_date_start)->format("d/M/Y");
            $obj->end = Carbon::parse($value->vigency_date_end)->format("d/M/Y");

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

    public static function DisableProduct($id)
    {
        $data = DB::table('clients')
                ->where('id', $id)
                ->update(['status' => false]);
        return $data;
    }
}
