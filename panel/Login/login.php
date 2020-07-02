<?php 

if (isset($_POST['login'])) {

	session_start();
	if (isset($_SESSION['loggedIN'])) {
		header("Location: /Escitorio");
	}


	// $connection = new mysqli( host: 'localhost', username: 'tecnotr1_master', passwd: 'ZOI!am6$)#A7', dbname: 'tecnotr1_panel');

	//$usuario = "tecnotr1_master";
	$usuario = "root";
	//$contrasena = "ZOI!am6$)#A7";  // en mi caso tengo contraseña pero en casa caso introducidla aquí.
	$contrasena = "";
	$servidor = "127.0.0.1";
	$basededatos = "tecnotr1_panel";


	


	//$conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos");

	//$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );



	$user = $_POST['usrPHP'];
	$pass = md5($_POST['passPHP']);

	// $data = $connection->query(query: "SELECT id_usuario FROM usuarios WHERE usuario='$user' AND pass_usuario='$pass' ");

	//$consulta = "SELECT id_usuario as id, nombre_usuario as name, apellido_usuario as lastname, tipo_usuario as type  FROM usuarios WHERE usuario='$user' AND pass_usuario='$pass'";

	//$data = mysqli_fetch_array(mysqli_query( $conexion, $consulta ));

	/*
	$_SESSION['id'] = $data['id'];
	$_SESSION['name'] = $data['name'];
	$_SESSION['lastname'] = $data['lastname'];
	$_SESSION['type'] = $data['type'];
	*/

	$_SESSION['id'] = 3;
	$_SESSION['name'] = 'Luis';
	$_SESSION['lastname'] = 'Ramirez';
	$_SESSION['type'] = 'ING';



	if (/*$data['id'] > 0*/1) {

		$_SESSION['loggedIN'] = '1';

		exit($data['id'] . " + " . $_SESSION['name']);

		
		// exit($_SESSION['id']);
	} else{
		exit("Failed");
	}

	// exit($user . " = " . $pass );

}


 ?>