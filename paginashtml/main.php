<?php
 session_start();
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

if ($mysqli->connect_errno) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}else if
 

(!empty($_SESSION['nameuser']))
{ 
 
 $sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id= '".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";

$mysqli->query($sql);
$fecha = time();


$sql= "select nombres, (sum(valor_a_ahorrar)- sum(valor_a_retirar)) from usuarios inner join ahorros on ahorros.usuario= usuarios.documento where nombres ='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
$saldo=mysqli_fetch_array($result);
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
    <title>Principal</title>
    <link rel="stylesheet" type="text/css" href="../css/stylemain.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="main.php"><img src="../images/logo empresa pequeño.png"  class="d-inline-block align-text-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item dropdown">
          <a
           class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../images/enviar.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">Documentos
          </a>
          <ul class="dropdown-menu">
         <li> <p>
  <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
    Certificado ahorro
  </button>
</p>
<div style="min-height: 3px;">
  <div class="collapse collapse-vertical" id="collapseWidthExample">
    <div class="btn-group dropstart" style="width: 140px;">
    <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="../conexionphp/certificado.php">Con saldo</a></li>
    <li><a class="dropdown-item" href="../conexionphp/certificado2.php">Sin saldo</a></li>
   
</ul>
  
    </div>
  </div>
</div></li>
            <li><a class="dropdown-item" href="../conexionphp/solicitud.php">Solicitud credito</a></li>
           
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a  class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../images/pago-por-clic.png"  alt="Logo" width="40" height="40" class="d-inline-block align-text-top"> Pagos</a>
          <ul class="dropdown-menu">
        
        
        <li><a class="dropdown-item" href="formpagos.php">Pagos</a></li>
        <li><a class="dropdown-item" href="enviar.php"> Envio a otro usuario</a></li>
</ul>
</li>
<li class="nav-item dropdown">
          <a
           class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="../images/User_icon_2.svg.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top"> <?php echo
 ucwords($_SESSION["nameuser"]);?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../conexionphp/perfil.php">Perfil</a></li>
            <li><a class="dropdown-item" href="formpass.php">Cambiar contraseña</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../conexionphp/logout.php">Cerrar sesion</a></li>
          </ul>
        </li>
      
      </ul>
      <form class="d-flex" role="search" action="../conexionphp/concept.php" method="post">
        <input class="form-control me-2" name="concepto" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</nav><br><br><br>
<div class="card text-center">
  <div class="card-header">
    AUTOGESTION SISTEMA DE INFORMACION AHORROS FAMILIAR
  </div>
  <div class="card-body">
    <h5 class="card-title"> <?php echo strtoupper($_SESSION["nameuser"]);?></h5>
    <p class="card-text">Saldo disponible <h5>$<?php echo number_format($saldo['(sum(valor_a_ahorrar)- sum(valor_a_retirar))'],2);?></h5></p>
<form method="post" action="../conexionphp/behavior.php">
         
      <button class="btn btn-primary" type="submit">Mi comportamiento financiero</button>
</form>
  </div>
  <div class="card-footer text-body-secondary">
   Ultimo acceso  <?php echo  date('Y-m-d H:i:s', strtotime('-17 hour'));?>
  </div>
</div>
<h2 class="info">Bienvenido al sistema de informacion de ahorros familiar</h2>
<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Movimientos</h5>
        <form action="../conexionphp/mostrarmovimientos.php" method="post">
        <p class="card-text"></p>
<br>
        <button type="submit" class="btn btn-primary">Consultar</button>
</form>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <form action="../conexionphp/mostrarmovimientosxmes.php" method="post">
        <h5 class="card-title">Movimientos por mes</h5>
        <p class="card-text"> <select name="fecha"class="form-select" aria-label="Default select example" id="month" style="color:#0ba842 ;"   required>
        <option value="">---Seleccione mes---</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                     <option value="9">Septiembre</option>
                     <option value="10">Octubre</option>
                     <option value="11">Noviembre</option>
                     <option value="12">Diciembre</option>
                    </select></p>
                    <br>

       <button type="submit" class="btn btn-primary">Consultar</button> 
</form>
      </div>
    </div>
  </div>
 </div>
 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> 
</body>
</html>