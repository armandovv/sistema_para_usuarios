<?php
session_start();

$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');
  if ($mysqli->connect_errno) {
    echo'Error de conexión: ';
	
	exit;
}
else if

(!empty($_SESSION['nameuser']))

{
//echo "la coneccion fue exitosa";

$fecha = $_POST['fecha'];
$sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id='".$_SESSION['id']."' and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
$mostrar=mysqli_fetch_array($result);

$fecha = $_POST['fecha'];
$sql = "select distinct month(fecha) from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2025 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
$sql1 = "SELECT sum(valor_a_retirar) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where  year(fecha)>= 2025 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$sql2="select sum(valor_a_ahorrar)-sum(valor_a_retirar) as saldo from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result1=mysqli_query($mysqli, $sql1);
$result2=mysqli_query($mysqli, $sql2);

$mostrar1=mysqli_fetch_array($result1);
$mostrar2=mysqli_fetch_array($result2);
$sql3 = "select *from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)= 2025 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$result3=mysqli_query($mysqli, $sql3); 


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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos financieros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .table{

            max-width: 1000px;
            margin: auto;
        }
        </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../paginashtml/main.php">VOLVER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            DESCARGAR EXTRACTO DEL MES
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">
            <form method="post" action="extracto.php">
                <input type="hidden" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="fecha" value="<?php echo $_POST['fecha']; ?>">
                <input type="submit" value="PDF">
            </form>
            </a></li>
            <li><a class="dropdown-item" href="#">
            <form method="post" action="extractoxls.php">
                <input type="hidden" name="usuario" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="fecha" value="<?php echo  $_POST['fecha']; ?>">
                <input type="submit" value="XLSX">
            </form>
            </a></li>
           
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="bx1" align="center">
<img src="../images/logo corp1.png">
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID MOVIMIENTO</th>
      <th scope="col">FECHA</th>
      <th scope="col">VALOR A AHORRAR</th>
      <th scope="col">VALOR A RETIRAR</th>
      <th scope="col">CONCEPTO</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if($result3->num_rows > 0){
  while($mostrar3=mysqli_fetch_array($result3)){
  echo'<tr>';
     echo'<th scope="row">'.$mostrar3['id_movimiento'].'</th>';
     echo'<th scope="row">'.$mostrar3['fecha'].'</th>';
     echo'<th scope="row">'.number_format($mostrar3['valor_a_ahorrar']).'</th>';
     echo'<th scope="row">'.number_format($mostrar3['valor_a_retirar']).'</th>';
     echo'<th scope="row">'.$mostrar3['concepto'].'</th>';
   echo'</tr>';
  }
    }else{
        header('location: no_encontrado.php?fecha='.$_POST['fecha'].'');
    }
    ?>
     </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>   
</body>
</html>