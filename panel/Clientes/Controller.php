<?php

define('__ROOT__', dirname(dirname(__FILE__)));
require_once ('../DbHelper/Connection.php');

if (isset($_POST['form']) && isset($_POST['type'])) 
{
    $data = $_POST['form'];
    $type = $_POST['type'];

    switch($type)
    {
        case "save":
            echo SaveClient($data);
        break;

        case "read":
            echo GetClients();
        break;

        case "add-sucursal":
            echo AddSucursal($data);
        break;

        case "save-contacts":
            echo AddContacts($data);
        break;

        default:
        break;
    }
}

function SaveClient($data)
{
    $name = $data[0]["value"];
    $razon = $data[1]["value"];
    $rfc = $data[2]["value"];
    //$sucursales = [];
    $sucursal = $data[3]["value"];
    $contactos = [];
    unset($data[0], $data[1], $data[2], $data[3]);
    $data = array_values($data); 
    $number = 1;

    /*
    for($i = 0; $i < count($data); $i++)
    {
        if($data[$i]["name"] == "client-sucursal-$number")
        {
            $sucursales[] = [
                "sucursal" => $data[$i]["value"]
            ];
            unset($data[$i]);
            $number++;
        }
    }
    */

    $data = array_values($data); 
    $count = count($data) / 3;
    $index = 0;

    for($i = 0; $i < $count; $i++)
    {
        $contactos[] = [
            "name" => $data[$index]["value"],
            "email" => $data[$index + 1]["value"],
            "telefono" => $data[$index + 2]["value"]
        ];
        $index += 3;
    }
    return Connection::InsertarCliente($name, $razon, $rfc, $sucursal, json_encode($contactos));
}

function GetClients()
{
    $data = Connection::GetClients();
    return json_encode($data); 
}

function AddSucursal($data)
{
    $obj = json_decode(json_encode($data));
    return Connection::AddSucursal($obj->id, $obj->sucursal);
}

function AddContacts($data)
{
    $cliente = $data[0]["value"];
    $sucursal = $data[1]["value"];
    $contactos = [];
    unset($data[0], $data[1]);
    $data = array_values($data); 
    $number = 1;

    $data = array_values($data); 
    $count = count($data) / 3;
    $index = 0;

    for($i = 0; $i < $count; $i++)
    {
        $contactos[] = [
            "name" => $data[$index]["value"],
            "email" => $data[$index + 1]["value"],
            "telefono" => $data[$index + 2]["value"]
        ];
        $index += 3;
    }
    return Connection::InsertarContactos($cliente, $sucursal, json_encode($contactos));
}

?>