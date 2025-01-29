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
}else {
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
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/pass.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script language="Javascript"  type="text/javascript">
  function validar(){
 
  var pasNew1=document.getElementById("nueva").value;
  var pasNew2=document.getElementById("confirm").value;

if(pasNew1!= pasNew2){
alert("CAMPO CONTRASEÑA NUEVA Y CAMPO CONFIRMACION NO COINCIDEN");
document.getElementById("nueva").focus();
document.getElementById("nueva").value="";
document.getElementById("confirm").value="";

return false;
} else{
  
  return true;
}

}


</script>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="main.php"><img src="../images/logo empresa pequeño.png" alt="" class="d-inline-block align-text-top"></a>
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
            <li><a class="dropdown-item" href="#">Solicitud credito</a></li>
           
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="../images/pago-por-clic.png"  alt="Logo" width="40" height="40" class="d-inline-block align-text-top"> Pagos</a>
       
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
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</nav><br><br><br>
<h2>Cambiar contraseña</h2>
<form action="../conexionphp/updatepass.php" method="post"  onsubmit="return validar()">
<div class="mb-3 row">
<input type="hidden" name="id" id="id" value="<?php echo $_SESSION["id"];?>">

  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña nueva</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="nueva" name="contraseña" required pattern=".{6,}" title="Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Confirme</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="confirm" name="confirm">
    </div>
   </div>
   <div>
   <button type="submit" class="btn btn-primary">CAMBIAR</button>
</div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
</body>
</html>