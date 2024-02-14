

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
.card {
	margin-left: auto;
    margin-right: auto;}

</style>

 </head>
 <body>

<div class="card" style="width: 18rem;" id="content">
  <img src="../images/User_icon_2.svg.png" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Informacion general</h5>
    <p class="card-text">Nombres <?php echo ucwords($mostrar['nombres']);?> </p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Numero documento <?php echo $mostrar['documento'];?></li>
    <li class="list-group-item">Correo electronico <?php echo $mostrar['email'];?></li>
    <li class="list-group-item">Telefono de contacto <?php echo $mostrar['telefono'];?></li>
  </ul>
  <div class="card-body">
    <a href="../paginashtml/actualizar_datos.php" class="card-link">Actualizar datos</a>
    <a href="../paginashtml/main.php" class="card-link">volver</a>
  </div>
 
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>   
</body>
</html>