<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public static function GetClients()
    {
        $clients = DB::table('clients')->select('id', 'name', 'alias', 'rfc', 'date_add')->get();
        return $clients;
    }
}
