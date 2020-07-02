<?php

//define('__ROOT__', dirname(dirname(__FILE__)));
//require_once (__ROOT__. '\DbHelper\Connection.php');
require_once ('../DbHelper/Connection.php');

if (isset($_POST['form']) && isset($_POST['type'])) 
{
    $data = $_POST['form'];
    $type = $_POST['type'];

    switch($type)
    {
        case "save":
            echo SaveCotization($data);
        break;

        case "read":
            echo ObtenerCotizaciones($data, 'NULL','NULL', 'NULL');
        break;

        case "get-emails":
            echo GetCorreos($data);
        break;

        case "update-product":
            echo ActualizarProducto($data);
        break;

        case "add-new-product":
            var_dump(AgregarProducto($data));
        break;

        default:
        break;
    }
}

function SaveCotization($data)
{
    $userId = $data[0]["value"];
    $statusId = $data[1]["value"];
    $clientId = $data[2]["value"];
    unset($data[0], $data[1], $data[2]);
    $data = array_values($data); 
    $products = [];
    $count = (count($data) / 4);

    for($i = 0; $i < $count; $i++)
    {
        $products[] = [
            "id" => $data[$i + ($i*3)]["value"], 
            "quantity" => $data[$i + ($i*3) + 1]["value"],
            "cost" => $data[$i + ($i*3) + 2]["value"],
            "utility" => $data[$i + ($i*3) + 3]["value"]
        ];
    }
    $productsJson = json_encode($products, JSON_NUMERIC_CHECK);
    return Connection::InsertCotization($clientId, $userId, $productsJson, $statusId);
}

function ObtenerCotizaciones($data, $client, $user, $status)
{
    $obj = json_decode($data);
    $data = Connection::ObtenerCotizaciones($obj->startDate . " 00:00:00", $obj->endDate . " 23:59:59", 'NULL', $client, $user, $status);
    $newArray = [];

    foreach($data as $item)
    {
        $date = new DateTime($item["creation_date"]);
        $vigency = new DateTime($item["creation_date"]); 
        $vigency = $vigency->add(new DateInterval('P15D'));

        $newArray[] = [
            "id" => $item["id"],
            "id_cliente" => $item["id_cliente"],
            "name" => $item["name"], 
            "creation_date" => $date->format('d/M/Y H:i'),
            "vigency_date" => $vigency->format('d/M/Y'),
            "items" => $item["items"],
            "total" => round($item["total"] * 100) / 100,
            "status_name" => $item["status_name"],
            "usuario" => $item["usuario"]
        ];
    }
    return json_encode($newArray);
}

function GetCorreos($data)
{
    $obj = json_decode(json_encode($data));
    return json_encode(Connection::GetEmails($obj->idCliente, $obj->idSucursal));
}

function ActualizarProducto($data)
{
    $obj = json_decode(json_encode($data));
    return Connection::UpdateProduct($obj->idCotizacion, $obj->idProducto, $obj->newCosto, $obj->newUtilidad);
}

function AgregarProducto($data)
{
    $obj = json_decode(json_encode($data));
    return Connection::AddCotizationProduct($obj->cotizacion, $obj->producto, $obj->cantidad, $obj->costo, $obj->utilidad);
}

?>