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
$mostrar=mysqli_fetch_array($result);
// Función para ocultar los primeros dígitos del número de documento
function maskDocumentNumber($documento) {
  
  $maskLength = strlen($documento) - 5;
  return str_repeat('*', $maskLength) . substr($documento, -5);
}
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
            header('location: ended_sesion.php');
  
            exit();
        
  } else {
    //Activamos sesion tiempo.
    $_SESSION['time'] = time();
  }
  }    

}else {
    echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';
  
    echo "<script>location.href='../index.html'</script>";
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actualizar datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
.g-3{

    margin-left: auto;
margin-right: auto;
position: relative;
top: 100px;
}


        </style>
  </head>
    <body>
        
<form class="row g-3" action="verify_pass.php" method="POST">
  <div class="col-auto">
    <label for="staticEmail2">Verificar contraseña</label>
   
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">contraseña</label>
    <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="contraseña" required>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Confirmar</button>
  </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>