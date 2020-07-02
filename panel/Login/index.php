<?php 
session_start();
	if (isset($_SESSION['loggedIN'])) {
		header("Location: /Escritorio");
	}


 ?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

       <title>Login | BackEnd</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- <link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 -->

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <form class="form-signin" id="formlg" method="POST">
  <div class="text-center mb-4">
    <img class="mb-4" src="img/logo_alone.png" alt="" width="50%">
    <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
    <!-- <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p> -->
  </div>

  <div class="form-label-group">
    <input type="text" id="inputUsuario" name="inputUsuario"  class="form-control" placeholder="Usuario" required autofocus>
    <label for="inputUsuario">Usuario</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="inputPassword"  class="form-control" placeholder="Contraseña" required>
    <label for="inputPassword">Contraseña</label>
  </div>

  <div class="checkbox mb-3">
    <!-- <label>
      <input type="checkbox" value="remember-me"> Recordar Usuario
    </label> -->
  </div>
  <input type="button" class="btn btn-lg btn-primary btn-block" id="entrar" value="Entrar">
<!--   <button class="btn btn-lg btn-primary btn-block" id="entrar" type="">Entrar</button> -->
  <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<script type="text/JavaScript">
	$(document).ready(function(){
		$("#entrar").on('click', function () {
			var usr = $("#inputUsuario").val();
			var pass = $("#inputPassword").val();
			if (usr == "" || pass == "") {
				alert('Formulario Vacio...');
			}
			else{

			$.ajax(
			{
				url: 'login.php',
				method: 'POST',
				data: {
					login: 1,
					usrPHP: usr,
					passPHP: pass 
				},
				beforeSend:function(){
					$("#entrar").val("Validando....");

				},
				success: function(response) {
					 console.log(response);
					setTimeout(alert('Bienvenido....'), 3000);
					//location.href = "/Escritorio";
          location.href = "http://127.0.0.1/panel/Escritorio/";

				},
				dataType: 'text'

			}

				);

			}

			});

			console.log(usr);
			console.log(pass);

		});


	

  

</script>