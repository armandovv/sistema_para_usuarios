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
	
			/* liberar el conjunto de resultados */
			
			echo '<h3>BIENVENIDO ',strtoupper($nameuser),' </h3>';
			
			
			
			echo"<a href='../paginashtml/main.php'><button style='border-width: 6px; border-radius:14%; background-color: #3C66F4; border-color:#F5F7F9; border-style:double;width:90; height:36; color:white'>aceptar</button></a>";
			
			
		}
			
			
			
		
		
	


	
		else {
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='../login.html'</script>";
		}
	
	
	

?>