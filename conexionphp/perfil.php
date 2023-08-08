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
$sql="select*from login_usuario inner join usuarios on usuarios.documento = login_usuario.id where '".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."' ";
$result=mysqli_query($mysqli, $sql);
if($result->num_rows > 0){
    while ($mostrar=mysqli_fetch_array($result)){
echo"<center>";

echo"<h3>",'Nombres: ' ,$mostrar['nombres']."</h3>";
echo"<h3>",'Documento: ' ,$mostrar['documento']."</h3>";
echo"<h3>",'Email: ' ,$mostrar['email']. "</h3>";
echo"<h3>",'Telefono: ' ,$mostrar['telefono']. "</h3>";
echo'<a href="../paginashtml/actualizar_datos.php"><input type="button" value="Actualizar informacion"></a><br>';
echo'<a href="../paginashtml/actualizar_datos.php">VOLVER</a>';
echo"</center>";

    }







}   

}
?>
