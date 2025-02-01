

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
function maskDocumentNumber($number, $string='****') {
  
  $maskLength = substr($number, -4);
  return $string . $maskLength;
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
    
    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color:rgb(214, 192, 192);
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 40%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      
    }
    .ref{   color:rgb(62, 15, 216);
	text-decoration-line: underline;
	cursor:pointer;
}
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
    <li class="list-group-item">Numero documento  <?php echo maskDocumentNumber($mostrar['documento']);?></li>
    <li class="list-group-item">Correo electronico <?php echo $mostrar['email'];?></li>
    <li class="list-group-item">Telefono de contacto <?php echo maskDocumentNumber($mostrar['telefono']);?></li>
  </ul>
  <div class="card-body">
  <a class="ref" id="myBtn">Actualizar datos</a> &nbsp;  &nbsp;
    <a href="../paginashtml/main.php" class="card-link">volver</a>
  </div>
 
</div>
<<div id="myModal" class="modal">

<!-- Contenido del Modal -->
<div class="modal-content">
  <span class="close">&times;</span>
  <form action="verify_pass.php" method="post">
   
    <img src="../images/bloquear - copia.png" alt="Descripción de la imagen" style="width:50%; max-width:50px; display:block; margin:auto;">
    <h3>Validación de Contraseña</h3> <!-- Imagen agregada -->
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="contraseña">
    <input type="submit" value="Enviar">
  </form>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
<script>
  // Obtener el modal
  var modal = document.getElementById("myModal");

  // Obtener el botón que abre el modal
  var btn = document.getElementById("myBtn");

  // Obtener el elemento <span> que cierra el modal
  var span = document.getElementsByClassName("close")[0];

  // Cuando el usuario hace clic en el botón, abrir el modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // Cuando el usuario hace clic en <span> (x), cerrar el modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // Cuando el usuario hace clic en cualquier lugar fuera del modal, cerrarlo
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
</body>
</html>