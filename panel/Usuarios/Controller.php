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

        default:
        break;
    }
}

function SaveClient($data)
{
    $name = $data[0]["value"];
    $apellido = $data[1]["value"];
    $email = $data[2]["value"];
    $tel = $data[3]["value"];
    $password = md5($data[4]["value"]);
    $user = substr($name, 0, 1) . $apellido;
    $alta = date("Y-m-d");
    return Connection::InsertarUsuario($name, $apellido, $email, $tel, $password, $user, $alta);
}

?>