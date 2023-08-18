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
    $id = $_POST['id'];	
	$contraseña=$_POST['contraseña'];
	$nueva=$_POST['nueva'];


	
	$query =mysqli_query ($conn,"select *from login_usuario where contraseña = '".$contraseña."'");
	$nr= mysqli_num_rows($query);
	if ($nr!=1)
	{ echo '<script>alert("LA CONTRASEÑA ACTUAL INGRESADA NO CORRESPONDE A SU CLAVE ACTUAL")</script> ';
		
        echo "<script>location.href='../paginashtml/formpass.php'</script>";
		
		}
			
			
			
		
		
	


	
		else {
			
            $query =mysqli_query($conn,"update login_usuario set contraseña=('".$nueva."') where id='".$id."'");
            
			
			echo '<center><h3>SE CAMBIO EXITOSAMENTE LA CONTRASEÑA</h3><center><br> ';
			
			echo"<a href='../paginashtml/main.php'>VOLVER</a>";
			

		}
	
        

?>