<?php
//include("connect_db.php");

//$miconexion = new connect_db;


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

	$id=$_POST['id'];
	$contraseña=$_POST['contraseña'];


	//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$query =mysqli_query ($conn,"select id, nombres, contraseña from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id= '".$id."'"); 
	$nr= mysqli_num_rows($query);
	$mostrar = mysqli_fetch_array($query);
	
	if (($nr==1)  && password_verify($contraseña,$mostrar['contraseña']  ) )
	{ 

		
		session_start();
		$_SESSION['id'] = $id;
	
	
	
			$fila = $query->fetch_row();
	
			/* la columna uno corresponde con la columna del nombre completo */
			$nameuser = $mostrar['nombres'];
	
			/* Podrías guardarlo como variable de sesión */
			$_SESSION['nameuser'] = $nameuser;
	       
			
			
			
			
		}
			
			
			
		
		
	


	
		else {
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='../login.html'</script>";
		}
	
	
	

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio de sesion</title>
	<link rel="icon" href="../images/pesos.png">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<style>
.card {
margin-left: auto;
margin-right: auto;}



</style>
</head>
<div class="card" style="width: 18rem;">
<img src="../images/ezgif.com-animated-gif-maker.gif" class="card-img-top" alt="...">
<div class="card-body">
<h5 class="card-title">Inicio de sesion</h5>
<p class="card-text">Bienvenido <?php echo $_SESSION['nameuser'];?> </p>
<a href="../paginashtml/main.php" class="btn btn-primary">Aceptar</a>
</div>
</div>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 	
</body>
</html>
