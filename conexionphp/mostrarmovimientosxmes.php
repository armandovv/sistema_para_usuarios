
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"><div class="doc" id='content'>

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
echo'<h3 class="nom">Apreciado Cliente</h3>';
echo"<tr><td><h4>",strtoupper($mostrar['nombres']),"</h4></td></tr>";
echo"<tr><td><h4>" ,'documento ',$mostrar['id']."</h4></td></tr>";
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
 
    echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'])."</td>";  
    echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'])."</td>";  
	
}  
echo "</table>";
$fecha = $_POST['fecha'];
$sql = "select distinct month(fecha) from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());




echo"<CENTER><H4>",'MOVIMIENTOS ' ,strtoupper($monthName). "</H4></center>";

echo'<center><table class="enum-3" border=1>';

echo'<th width=100 bgcolor="blue">ID</th>';
echo'<th width=100 bgcolor="blue">FECHA</th>';
echo'<th width=200 bgcolor="blue">VALOR A AHORRAR</th>';
echo'<th width=200 bgcolor="blue">VALOR A RETIRAR</th>';
echo'<th width=200 bgcolor="blue">CONCEPTO</th>';
$sql = "select *from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);  
if($result->num_rows > 0){
{
while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table  class='enum-3' border=1>";  
 
    echo "<td width=100>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=100>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'])."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'])."</td>";  
    echo "<td width=200>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 


}
 }
else { echo' <script>alert("NO HAY MOVIMIENTOS PARA  '.strtoupper($monthName).'")</script> ';
	echo "<script>location.href='../paginashtml/main.php'</script>";
}
   }


?>
</div>
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

	margin-left: 80px;
}
 .nom{
	margin-left: 80px;
}

</style>
<center><button onclick="createPDF()">Descargar</button><br>
<a href='../paginashtml/main.php'>VOLVER</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function createPDF() {
        // get the element of ticket content.
        const docElement = document.getElementById('content');
	

        // select the element and save as the PDF.
        html2pdf().from(docElement).save('extract');
    }
</script>	</center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  
