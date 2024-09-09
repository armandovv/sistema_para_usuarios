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
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOLICITUD CREDITO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <style>
.mb-3{
max-width: 400px;
}
form .btn-primary{
 font-size: small;
   
    background-color: #3144c1;
    border: 0;
    text-transform: uppercase;
    padding: 1em;
  
    letter-spacing: .1em;
    border-radius: 25px;
}
</style>
    </head>
 <body>
 <div class="card">
  <div class="card-header">
    SOLICITUD INDIVIDUAL DE CREDITO
  </div>
  <div class="card-body">
  <h2>formato para solicitud de credito</h2>
<form action="../conexionphp/prestamos.php" method="post"  onsubmit="return validar()">
<div class="mb-3 row">
<input type="hidden" name="id" id="id" value="<?php echo $_SESSION["id"];?>">

  <div class="mb-3">
  
  
  <div class="form-text" id="basic-addon4">ingrese el monto del credito</div>
</div>
<div class="input-group mb-3">
  <span class="input-group-text">$</span>
  <input type="text" name="valor_prestamo"  class="form-control" aria-label="Amount (to the nearest dollar)">
  <span class="input-group-text">.00</span>
</div>
   </div>
   <div class="input-group mb-3">
  <select class="form-select" id="inputGroupSelect02" name="n_cuotas">
    <option selected>Seleccione...</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="24">24</option>
    <option value="36">36</option>
    <option value="48">48</option>
   
  </select>
  <label class="input-group-text" for="inputGroupSelect02">plazo meses</label>
</div>
   <div>
   <button type="submit" class="btn btn-primary">SOLICITAR</button>
</div>
</form>
  </div>
</div>
</body>
</html>