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
$usuario=$_POST['usuario'];
echo'<table><center>';
echo'<form name="eliminar" method="POST"  action="../conexionphp/send_user.php">';
   echo'<h2>ENVIO DINERO A UN USUARIO</h2><br>';
    
      //Creamos la sentencia SQL y la ejecutamos
      $sql=" select distinct usuario from usuarios inner join ahorros on ahorros.usuario= usuarios.documento where usuario='".$usuario."' ";
      $result=mysqli_query($mysqli, $sql);
      while ($mostrar=mysqli_fetch_array($result)){
      echo'<input type="hidden" name="usuario" id="usuario"  value=" ',$mostrar['usuario'].'" >'; 
      echo '<tr><td>fecha</td><td><input type="date" name="fecha" id="fecha" required></td></tr>';
      echo'<tr><td>cantidad a enviar</td><td><input type="text" name="valor_a_ahorrar" id="valor_a_ahorrar" required></td></tr>';
      echo'<input type="hidden" name="valor_a_retirar" id="valor_a_retirar">';
     
      echo'<input type="hidden" name="concepto" id="concepto" value="deposito ',$mostrar['usuario'].'">';
      
     echo' <input type="hidden" name="usuario1" id="usuario1" value="',$_SESSION['id'].'">';
     echo'<input type="hidden" name="valor_a_ahorrar1" id="valor_a_ahorrar1">';
     echo'<input type="hidden" name="valor_a_retirar1" id="valor_a_retirar1">';
     echo'<input type="hidden" name="concepto1" id="concepto1" value="envio ',$mostrar['usuario'].'">';
      }
    echo'<br><br>';
   echo'<tr><td><input TYPE="submit" value="ENVIAR"  style="width:200px; height:30px"></td></tr>';
echo'</form>';
echo'</center></table>';
echo'<br>';
}

echo"<center><a href='../paginashtml/enviar.php'>VOLVER</a></center>";
?>
<script type="text/javascript" language="javascript"> 
function copy_input(){

document.getElementById('valor_a_retirar1').value = document.getElementById('valor_a_ahorrar').value;
}
</script>