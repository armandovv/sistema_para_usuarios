<?php
session_start();
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else if
(!empty($_SESSION['nameuser']))

{
$email= $_POST['email'];
$sql="update login_usuario inner join usuarios on usuarios.documento= login_usuario.id set email= '".$email."' where '".$_SESSION['id']."' and  nombres='".$_SESSION['nameuser']."' ";

$mysqli->query($sql);
echo "Email actualizado!!! </br>";
}
$mysqli->close();
echo"<a href='./perfil.php'>VOLVER</a>";
?>