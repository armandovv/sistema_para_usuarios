<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<header>
<nav class="navbar bg-body-tertiary">
  <form class="container-fluid justify-content-start">
    <button class="btn btn-outline-success me-2" type="button"  onclick="createPDF()">Descargar certificado</button>
    <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-primary" type="button">VOLVER</button></a>
  </form>
</nav>
</header>
<div class="doc" id='content'>
<center><div class="logo">
  <img src="../images/logo corp1.png" class="rounded" alt="..."/>
</div></center>
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
$sql="select distinct nombres, id from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id='".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
if($result->num_rows > 0){
while ($mostrar=mysqli_fetch_array($result)){
  echo '<br>';
  echo '</br>';
echo"<center><table>";


echo'<tr><td><h5><center>CERTIFICADO</h5></center></td></tr>';
echo"<tr><td>",'Por medio de la presente, hacemos constar que el señor(a) ',ucwords($mostrar['nombres']).' con documento ',$mostrar['id'].':'."</td></tr>" ; }
$sql=" select min(fecha) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
echo "<tr><td>",'posee sus ahorros en nuestro sistema desde la fecha ' ,$mostrar['min(fecha)']."</td></tr>"; }
$sql="SELECT  sum(valor_a_ahorrar)-sum(valor_a_retirar) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
 echo "<tr><td id='saldo'>",'saldo a la fecha $' ,number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'],2).' pesos MCTE'."<td></td><td width=50></td></tr>" ;
}
setlocale(LC_TIME, "spanish");
echo "<tr><td>" ,"Se expide este certificado a solicitud del interesado el dia ",utf8_encode(strftime("%A %d de %B del %Y")),"</td></tr>"; 


echo"<tr height= 90></tr>";
echo "<tr><td>Cordialmente</td></tr>"; 
echo "<tr><td><img src=../images/firma.jpeg width=190 height=75></td></tr>";
echo "<tr><td>Jorge Armando Varela</td></tr>";  
echo "<tr> <td>Administrador financiero</td></tr>"; 
echo'<tr height= 110><td><h5>SISTEMA DE INFORMACION DE AHORROS FAMILIAR</h5></td></tr>';
echo "</table></center>";


}
else { echo' <script>alert("USUARIO NO EXISTE EN LA BASE DE DATOS")</script> ';
	echo "<script>location.href='../paginas/mostrar_estado.php'</script>";
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
  
}else{

  echo'<script>alert("SE CERRO LA SESION DE FORMA INESPERADA");</script>';
  echo "<script>location.href='../index.html'</script>";

}


?>
</div>
<style>
 
 
header .bg-body-tertiary .container-fluid  .btn-primary{

border-radius: 30px;
}
.logo{
  background: url('../images/header13.png')no-repeat center center fixed; 
   
   -webkit-background-size: cover;
   -moz-background-size: cover;
   -o-background-size: cover;
   background-size: cover;
  
}

</style>



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function createPDF() {
      var element = document.getElementById('content');
      
     if (confirm('desea descargar certificado de ahorros')){
    
var opt = {
  margin:       1,
  filename:     'certificado de ahorro.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();

// Old monolithic-style usage:
html2pdf(element, opt);
    }}
</script></center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  