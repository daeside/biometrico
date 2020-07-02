<?php
$mysqli = new mysqli('localhost','tecnotr1_master','N0m34cu3rd01.','tecnotr1_panel');
if ($mysqli -> connect_errno) :
	echo "Error al Conectarse con MySQL debido al error".$mysqli -> connect_errno;
endif;

 ?>