<?php
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
$documento= $_POST['documento'];	
$email= $_POST['email'];
$query= mysqli_query($conn, "select *from usuarios where  email='".$email."'");
$nr= mysqli_num_rows($query);
if($nr>0){
 echo'<script>alert("EL EMAIL INGRESADO YA ESTA EN USO")</script>';
 echo "<script>location.href='../paginashtml/actualizar_datos.php'</script>";
}else{
	$query =mysqli_query($conn,"update usuarios set email= '".$email."' where documento='".$documento."'");


echo "<script>alert('SE ACTUALIZO EL EMAIL')</script>";
echo "<script>location.href='perfil.php'</script>";
}
  


?>