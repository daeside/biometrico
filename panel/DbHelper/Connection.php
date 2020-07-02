<?php

require ('Data.php');

class Connection
{
    private static function DbConnection()
    {
        $conexion = mysqli_connect( SERVER, USER, PASSWORD ) or die ("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db( $conexion, DATABASE ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
        mysqli_set_charset($conexion,"utf8");
        return $conexion;
    }

    public static function SelectAllData($table)
    {
        $query = "SELECT * FROM $table";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $data;
    }

    public static function SelectAllDataOrder($table, $row, $order)
    {
        $query = "SELECT * FROM $table ORDER BY $row $order";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = [];
        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                if($table == "clientes_sucursales")
                {
                    $data[] = [
                        "id" => $row["id"],
                        "id_clientes" => $row["id_clientes"],
                        "nombre" => $row["nombre"]
                    ];
                }
                else if($table == "clientes")
                {
                    $data[] = [
                        "id" => $row["id"],
                        "name" => $row["name"],
                        "razon_social" => $row["razon_social"],
                        "rfc" => $row["rfc"]
                    ];
                }
                else if($table == "productos")
                {
                    $data[] = [
                        "id" => $row["id"],
                        "code" => $row["code"],
                        "description" => $row["description"]
                    ];
                }
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public static function GetEmails($id, $idSucursal)
    {
        $query = "SELECT * FROM clientes_detalle WHERE id_clientes = $id AND id_sucursal = $idSucursal ORDER BY id ASC";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = [];
        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $data[] = [
                    "id" => $row["id"],
                    "id_clientes" => $row["id_clientes"],
                    "nombre" => $row["nombre"],
                    "correo" => $row["correo"],
                    "telefono" => $row["telefono"],
                    "id_sucursal" => $row["id_sucursal"]
                ];
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public static function SelectAllDataOrderWhere($table, $row, $order, $id)
    {
        $query = "SELECT * FROM $table WHERE id_clientes = '$id' ORDER BY $row $order";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = [];
        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $data[] = [
                    "id" => $row["id"],
                    "id_clientes" => $row["id_clientes"],
                    "nombre" => $row["nombre"]
                ];
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public static function InsertCotization($client, $user, $items, $status)
    {
        $query = "CALL spGuardarCotizacion($client, $user, '$items', $status)";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }
    
    public static function ObtenerCotizaciones($starDate, $endDate, $cotization, $client, $user, $status)
    {
        $query = "CALL spObtenerCotizaciones('$starDate', '$endDate', $cotization, $client, $user, $status)";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = [];
        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $data[] = [
                    "id" => $row["id"],
                    "id_cliente" => $row["id_cliente"],
                    "name" => $row["name"],
                    "creation_date" => $row["creation_date"],
                    "items" => $row["items"],
                    "total" => $row["total"],
                    "status_name" => $row["status_name"],
                    "usuario" => $row["usuario"],
                    "nombre_usuario" => $row["nombre_usuario"],
                    "apellido_usuario" => $row["apellido_usuario"]
                ];
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public static function InsertarCliente($name, $razon, $rfc, $sucursal, $jsonContactos)
    {
        $sucursal = str_replace('"', '\"', $sucursal);
        $query = "CALL spGuardarCliente('$name', '$razon', '$rfc', '$sucursal', '$jsonContactos')";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }

    public static function GetClients()
    {
        $query = "SELECT * FROM clientes";
        $result = mysqli_query(Connection::DbConnection(), $query);
        $data = [];
        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $data[] = [
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "razon_social" => $row["razon_social"],
                    "rfc" => $row["rfc"]
                ];
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public static function AddSucursal($id, $sucursal)
    {
        $sucursal = str_replace('"', '\"', $sucursal);
        $query = "INSERT INTO clientes_sucursales(id_clientes, nombre) VALUES($id, '$sucursal')";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }

    public static function InsertarContactos($cliente, $sucursal, $contactos)
    {
        $query = "CALL spGuardarContactos($cliente, $sucursal, '$contactos')";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }

    public static function ChangeStatus($id)
    {
        $query = "UPDATE cotizaciones SET fk_id_status = 4 WHERE id = $id";
        $execute = mysqli_query(Connection::DbConnection(), $query);
    }

    public static function InsertarUsuario($name, $apellido, $email, $tel, $password, $user, $alta)
    {
        $query = "INSERT INTO usuarios(usuario, pass_usuario, nombre_usuario, apellido_usuario, correo_usuario, tipo_usuario, alta_usuario) VALUES('$user', '$password', '$name', '$apellido', '$email', 'VEND', '$alta')";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }

    public static function InsertarProducto($code, $description)
    {
        $description = str_replace('"', '\"', $description);
        $query = "INSERT INTO productos(code, description) VALUES('$code', '$description')";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $query;
    }

    public static function UpdateProduct($id, $idproduct, $cost, $utility)
    {
        $query = "UPDATE cotizaciones_items SET utility = $utility, cost = $cost WHERE fk_id_cotizacion = $id AND fk_id_producto = $idproduct";
        $execute = mysqli_query(Connection::DbConnection(), $query);
        return $execute;
    }
}

?>