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
          echo "<script> alert('Se cerro la sesion por inactividad');window.location= '../login.php' </script>";

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
    <link rel="stylesheet" type="text/css" href="../css/stylepay.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script type="text/javascript" language="javascript">
  function confirmar(){
			var num= document.getElementById('valor_a_retirar').value;
      if(num==0){
          alert("introduzca un valor");
        }else{
			if (confirm("¿RETIRAR VALOR $" + new Intl.NumberFormat().format(num)+  "?" )){
			   document.retirar.submit()
			}
       else{
       
				document.getElementById('fecha').value="";		
         document.getElementById('valor_a_retirar').value="";
         document.getElementById('concepto').value="";
        }
			}
    }
		</script>	
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="main.php"><img src="../images/hogar.png" alt=""width="40" height="40" class="d-inline-block align-text-top"></a>
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
$_SESSION["nameuser"];?>
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
<h2>Pagos</h2>
<form name="retirar" action="../conexionphp/pagos.php" method="post">
<div class="input-group">
  <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION["id"];?>">
    <div>
  <span class="input-group-text">Fecha</span>
  <input type="date" name="fecha" id="fecha" aria-label="First name" class="form-control" required>
</div>
<input type="hidden" name="valor_a_ahorrar" id="valor_a_ahorrar">
 <div>
  <span class="input-group-text">Valor a pagar</span>
  <input type="text" name="valor_a_retirar" id="valor_a_retirar" aria-label="First name" class="form-control" required>
 </div>
</div><br>
 <div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01">Concepto</label>
  <select class="form-select" id="concepto" name="concepto" required>
    <option value="">Seleccione ...</option>
    <option value="prestamo">Prestamo express</option>
    <option value="pago servicios">servicios hogar</option>
   
  </select>
  <div>
  <button type="submit" class="btn btn-secondary" onclick="confirmar();">PAGAR</button>
</div>
</div>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>     
</body>
</html>