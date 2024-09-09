<?php
session_start();
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}else if
 

(!empty($_SESSION['nameuser']))
{ 


$sql = "select distinct month(fecha) as fecha from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>=2024 and login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);
while($mostrar=mysqli_fetch_array($result)){
$fecha =  $mostrar['fecha'];
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
}
if(isset($_SESSION['time']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 300;
  
    //Calculamos tiempo de vida inactivo.
    $fecha = time() - $_SESSION['time'];
  
        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($fecha > $inactivo)
        {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            header('location: ../conexionphp/ended_sesion.php');
  
            exit();
        
  } else {
    //Activamos sesion tiempo.
    $_SESSION['time'] = time();
  }
  } 
  }  else{
    echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';
  
    echo "<script>location.href='../index.html'</script>";
  }
  
  
   
  $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sin movimientos</title>
</head>
<body>
    NO HAY MOVIMIENTOS PARA EL MES  <?php echo strtoupper($monthName); ?>
    <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-outline-secondary" type="button">VOLVER</button></a>

    
</body>
</html>