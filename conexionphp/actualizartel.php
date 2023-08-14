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
$telefono= $_POST['telefono'];
$sql="update login_usuario inner join usuarios on usuarios.documento= login_usuario.id set telefono= '".$telefono."' where '".$_SESSION['id']."' and  nombres='".$_SESSION['nameuser']."' ";

$mysqli->query($sql);
echo "<script>alert('SE ACTUALIZO NUMERO DE TELEFONO')</script>";
echo "<script>location.href='perfil.php'</script>";
}
$mysqli->close();
echo"<a href='./perfil.php'>VOLVER</a>";
?>