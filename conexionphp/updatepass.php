<?php
session_start();
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn)
  {echo " LO SENTIMOS, ESTE SITIO WEB ESTA EXPERIMENTANDO PROBLEMAS  <BR>";
	echo "error: Fallo al conectarse a mysql debido a : <br>";
		echo"errno: " . $mysqli->connect_errno . "<br>";
	exit;}
	else if
(!empty($_SESSION['nameuser']))

{
    $id = $_POST['id'];	
	$contraseña=$_POST['contraseña'];
	
	

	
	$query =mysqli_query ($conn,"select *from login_usuario where id = '".$id."'");
	$nr= mysqli_num_rows($query);
	$mostrar = mysqli_fetch_array($query);
	 password_verify($contraseña,$mostrar['contraseña']);

	
		$contraseña = password_hash($contraseña,PASSWORD_DEFAULT);
		
		$query =mysqli_query($conn,"update login_usuario set contraseña='".$contraseña."' where id='".$id."'");
		
			if(isset($_SESSION['time']) ) {

				//Tiempo en segundos para dar vida a la sesión.
				$inactivo = 300;
			  
				//Calculamos tiempo de vida inactivo.
				$fecha = time() - $_SESSION['time'];
			  
					//Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
					if($fecha > $inactivo)
					{
						//Removemos sesión.
						session_unset();
						//Destruimos sesión.
						session_destroy();              
						//Redirigimos pagina.
						echo "<script> alert('Se cerro la sesion por inactividad');window.location= '../login.php' </script>";
			  
						exit();
					
			  } else {
				//Activamos sesion tiempo.
				$_SESSION['time'] = time();
			  }
			  } 
		
		}else{
			echo'<script>alert("SE CERRO LA SESION DE FORMA INESPERADA");</script>';
			echo "<script>location.href='../index.html'</script>";
			}   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimientos financieros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
.mb-3 {
	margin-left: auto;
    margin-right: auto;}

</style>
</head>
<body>
<div class="card mb-3" style="width: 18rem;">
  <img src="../images/ezgif.com-animated-gif-maker.gif" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Cambio de contraseña realizado</h5>
    <p class="card-text">Contraseña cambiada exitosamente</p>
    <p class="card-text"> <a href="../paginashtml/formpass.php" class="btn btn-primary">LISTO</a></p>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>