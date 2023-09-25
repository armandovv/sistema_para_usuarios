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
    $usuario = $_POST['usuario1'];	
    $fecha= date('Y-m-d');
    $valor_a_ahorrar= $_POST['valor_a_ahorrar1'];
    $valor_a_retirar= $_POST['valor_a_retirar1'];
    $concepto= $_POST['concepto1'];
    $consult= mysqli_query($mysqli, "select (sum(valor_a_ahorrar)-sum(valor_a_retirar)) as mtotal from ahorros inner join usuarios on usuarios.documento=ahorros.usuario where ahorros.usuario= '".$usuario."'");
    $row = mysqli_fetch_array($consult);
$total=$row['mtotal'];
if($total >= $valor_a_retirar ){
    $sql = "INSERT INTO ahorros Values(null, '".$usuario."','".$fecha."','".$valor_a_ahorrar."','".$valor_a_retirar."','".$concepto."'),(null,'".$usuario."','".$fecha."', '".$valor_a_ahorrar."', '".$valor_a_retirar."', '".$concepto."')";
    $mysqli->query($sql);
    echo "<a href='confirm.php'>CONFIRMAR ENVIO?</a>";


}else{
    echo '<script>alert("SU SALDO ACTUAL ES INSUFICIENTE: $',number_format($total).'" )</script> ';
		
    echo "<script>location.href='../paginashtml/enviar.php'</script>";
  
  }
  }
  
  $mysqli->close();
  echo"<a href='../paginashtml/enviar.php'>VOLVER</a>";
  ?>

