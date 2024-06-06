
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<header>
<nav class="navbar bg-body-tertiary ">
  <form class="container-fluid justify-content-start">
    <button class="btn btn-outline-success me-2" type="button"  onclick="createPDF()">Descargar extracto</button>
    <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-outline-secondary" type="button">VOLVER</button></a>
  </form>
</nav>
</header>
<div class="doc" id='content'>
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
//echo "la coneccion fue exitosa";
$fecha = $_POST['fecha'];
$sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id= '".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
   
echo"<table class='format'>";
echo'<div class="text-center">';
echo' <img src="../images/logo corp1.png" class="rounded" alt="...">';
echo'</div>';
echo'<h6 class="nom">Apreciado Cliente</h6>';
echo"<tr><td><h6>",strtoupper($mostrar['nombres']),"</h6></td></tr>";
echo"<tr><td><h6>" ,'documento ',$mostrar['id']."</h6></td></tr>";
echo"</table>"; } 
echo "<table class='format' border=1>";  
 echo "<td width=100>TOTAL RETIRADO</td>";  
echo "<td width=100>TOTAL AHORRADO</td>"; 
echo "</table>"; 

$sql = "SELECT sum(valor_a_retirar), sum(valor_a_ahorrar)-sum(valor_a_retirar) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);

while ($mostrar=mysqli_fetch_array($result))
{ 
echo "<table class='format' border=1>";  
 
    echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'],2)."</td>";  
    echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'],2)."</td>";  
	} 
echo "</table>";

$fecha = $_POST['fecha'];
$sql = "select distinct month(fecha) from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());




echo"<CENTER><H5>",'MOVIMIENTOS ' ,strtoupper($monthName). "</H5></center>";

echo'<center><table class="enum-3" border=1>';

echo'<th width=100 bgcolor="green">ID</th>';
echo'<th width=150 bgcolor="green">FECHA</th>';
echo'<th width=200 bgcolor="green">VALOR A AHORRAR</th>';
echo'<th width=200 bgcolor="green">VALOR A RETIRAR</th>';
echo'<th width=200 bgcolor="green">CONCEPTO</th>';
$sql = "select *from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);  
if($result->num_rows > 0){
{
while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table  class='enum-3' border=1>";  
 
    echo "<td width=100>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=150>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'],2)."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'],2)."</td>";  
    echo "<td width=200>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 


}
 }
else { echo' <script>alert("NO HAY MOVIMIENTOS PARA  '.strtoupper($monthName).'")</script> ';
	echo "<script>location.href='../paginashtml/main.php'</script>";
}if(isset($_SESSION['time']) ) {

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
<br>
<style>
.doc{

width: 880 px;
margin-left: auto;
    margin-right: auto;
}
 .enum-3{
	width: 780 px;

}
.doc .format{

	margin-left: 40px;
}
 .nom{
	margin-left: 40px;
}

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function createPDF() {
      var element = document.getElementById('content');
var opt = {
  margin:       1,
  filename:     'extracto.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();

// Old monolithic-style usage:
html2pdf(element, opt);
    }
</script>	</center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
