<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$documento = $_POST['documento'];

$queryusuario 	= mysqli_query($conn,"select contraseña, email from login_usuario inner join usuarios on usuarios.documento = login_usuario.id where documento= '".$documento."'");
$nr 			= mysqli_num_rows($queryusuario); 

if ($nr == 1)
{

$mostrar		= mysqli_fetch_array($queryusuario); 
$enviarpass 	=  $mostrar['contraseña'];

$paracorreo 		=$mostrar['email'];
$titulo				= "Recuperar contraseña";
$mensaje			="La clave que ingreso al sistema es:  $enviarpass por favor cambiala";
$tucorreo			= "From: varelaarmando430@gmail.com";

(mail($paracorreo,$titulo,$mensaje,$tucorreo));

	echo "<script> alert('Contraseña enviado');window.location= '../login.html' </script>";
}else
{
	echo "<script> alert('El documento ingresado no se encuentra en nuestra base de datos');window.location= '../login.html' </script>";
}


?>