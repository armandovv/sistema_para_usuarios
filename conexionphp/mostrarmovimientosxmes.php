<div id='cualquier'>

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
echo"<table>";
echo'<h3>Apreciado Cliente</h3>';
echo"<tr><td><h4>",strtoupper($mostrar['nombres']),"</h4></td></tr>";
echo"<tr><td><h4>" ,'documento ',$mostrar['id']."</h4></td></tr>";
echo"</table>"; } 
echo "<table border=1>";  
 echo "<td width=100>TOTAL RETIRADO</td>";  
echo "<td width=100>TOTAL AHORRADO</td>"; 
echo "</table>"; 
$sql = "SELECT sum(valor_a_retirar), sum(valor_a_ahorrar)-sum(valor_a_retirar) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);

while ($mostrar=mysqli_fetch_array($result))
{ 
echo "<table border=1>";  
 
    echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'])."</td>";  
    echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'])."</td>";  
	
}  
echo "</table>";

echo'<CENTER><H4>MOVIMIENTOS POR MES</H4></center>';
echo'<center><table border=1>';
echo'<th width=200 bgcolor="blue">ID MOVIMIENTO</th>';
echo'<th width=200 bgcolor="blue">FECHA</th>';
echo'<th width=200 bgcolor="blue">VALOR A AHORRAR</th>';
echo'<th width=200 bgcolor="blue">VALOR A RETIRAR</th>';
echo'<th width=200 bgcolor="blue">CONCEPTO</th>';
$sql = "select *from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2023 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$result=mysqli_query($mysqli, $sql);  
if($result->num_rows > 0){
{
while ($mostrar=mysqli_fetch_array($result))
{
	
echo "<table border=1>";  
 
    echo "<td width=200>",$mostrar['id_movimiento']."</td>";  
    echo "<td width=200 align='center'>",$mostrar['fecha']."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'])."</td>";  
	echo "<td width=200>",number_format($mostrar['valor_a_retirar'])."</td>";  
    echo "<td width=200 align='center'>",$mostrar['concepto']."</td>"; 
}  
echo "</table>"; 


}
 }
else { echo' <script>alert("NO HAY MOVIMIENTOS PARA EL MES '.$fecha.'")</script> ';
	echo "<script>location.href='../paginashtml/main.php'</script>";
}
   }


?>
</div>
<center><button type="input"><a href="javascript:imprSelec('cualquier')">IMPRIMIR</a></button><br>
<a href='../paginashtml/main.php'>VOLVER</a>
	<script language="Javascript">
	function imprSelec (cualquier)
	{ 
	var ficha=document.getElementById(cualquier);
	var ventimp=window.open('','popimpr');
	ventimp.document.write( ficha.innerHTML );
	ventimp.document.close();
	ventimp.print();
	ventimp.close();
	}
	</script>	</center>

