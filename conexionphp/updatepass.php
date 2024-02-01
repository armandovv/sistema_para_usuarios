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
		echo '<center><h3>SE CAMBIO EXITOSAMENTE LA CONTRASEÑA</h3><center><br> ';
			
			echo"<a href='../paginashtml/main.php'>VOLVER</a>";
		
		}else{
			echo'<script>alert("SE CERRO LA SESION DE FORMA INESPERADA");</script>';
			echo "<script>location.href='../index.html'</script>";
			}   
		
		
			
			
			
		
		
	


	
		
	
        

?>