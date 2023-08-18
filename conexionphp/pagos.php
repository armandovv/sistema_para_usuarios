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
    $usuario = $_POST['usuario'];	
    $fecha= $_POST['fecha'];
    $valor_a_ahorrar= $_POST['valor_a_ahorrar'];
    $valor_a_retirar= $_POST['valor_a_retirar'];
    $concepto= $_POST['concepto'];
    $consult= mysqli_query($mysqli, "select (sum(valor_a_ahorrar)-sum(valor_a_retirar)) as mtotal from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id= '".$_SESSION['id']."'");
    $row = mysqli_fetch_array($consult);
$total=$row['mtotal'];
if($total >= $valor_a_retirar ){
    $sql = "INSERT INTO ahorros Values(null, '".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."')";
    $mysqli->query($sql);
    echo "SU PAGO FUE REALIZADO CON EXITO  </br>";


}else{
    echo '<script>alert("SU SALDO ACTUAL ES INSUFICIENTE: $',number_format($total).'" )</script> ';
		
    echo "<script>location.href='../paginashtml/formpagos.php'</script>";
  
  }
  }
  
  $mysqli->close();
  echo"<a href='../paginashtml/formpagos.php'>VOLVER</a>";
  ?>

