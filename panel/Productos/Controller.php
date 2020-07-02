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
            echo SaveProduct($data);
        break;

        default:
        break;
    }
}

function SaveProduct($data)
{
    $obj = json_decode(json_encode($data));
    return Connection::InsertarProducto($obj[0]->value, $obj[1]->value);
}

?>