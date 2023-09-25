<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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
    
        echo"<table>";
        echo'<tr><td><img src="../images/User_icon_2.svg.png" width="200" height="200"></td></tr>';
        echo"<td><h3>",'Nombres: ' ,$mostrar['nombres']."</h3>";
        echo"<h3>",'Documento: ' ,$mostrar['documento']."</h3>";
        echo"<h3>",'Email: ' ,$mostrar['email']. "</h3>";
        echo"<h3>",'Telefono: ' ,$mostrar['telefono']. "</h3></td></tr>";
        echo'<tr><td><center><a href="../paginashtml/actualizar_datos.php"><input type="button" value="Actualizar informacion"></a><br>';
        echo'<a href="../paginashtml/main.php">VOLVER</a></center></td></tr>';
        echo"</table>";
    }







}   

}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  