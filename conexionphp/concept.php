<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
    $sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id= '".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";
    $result=mysqli_query($mysqli, $sql);
    while ($mostrar=mysqli_fetch_array($result)){
    echo"<table>";
    echo'<h3>Apreciado Cliente</h3>';
    echo"<td><h4>",ucwords($mostrar['nombres'])."</h4></td>";
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
     
        echo "<td width=100>",number_format($mostrar['sum(valor_a_retirar)'],2)."</td>";  
        echo "<td width=100>",number_format($mostrar['sum(valor_a_ahorrar)-sum(valor_a_retirar)'],2)."</td>";  
        
    }  
    echo "</table>";
    echo'<CENTER><H4>MOVIMIENTOS REGISTRADOS</H4></center>';
    echo'<center><table border=1>';
    echo'<th width=200 bgcolor="blue">ID MOVIMIENTO</th>';
    echo'<th width=200 bgcolor="blue">FECHA</th>';
    echo'<th width=200 bgcolor="blue">VALOR A AHORRAR</th>';
    echo'<th width=200 bgcolor="blue">VALOR A RETIRAR</th>';
    echo'<th width=200 bgcolor="blue">CONCEPTO</th>';
    echo "</table>";
    $concepto = $_POST['concepto'];
    $sql= "select *from ahorros inner join login_usuario on login_usuario.id= ahorros.usuario where concepto like  '%".$concepto."%' and login_usuario.id='".$_SESSION['id']."'";
    
    
    
      
    $result=mysqli_query($mysqli, $sql); 
    
       
    if($result->num_rows > 0){
      
         
           
         
         
           
           
     
        
    
    
     
    
    while ($mostrar=mysqli_fetch_array($result))
     
    {
          
         
    echo "<table border=1>";  
     
        echo "<td width=200>",$mostrar['id_movimiento']."</td>";  
        echo "<td width=200 align='center'>",$mostrar['fecha']."</td>";  
        echo "<td width=200>",number_format($mostrar['valor_a_ahorrar'],2)."</td>";  
        echo "<td width=200>",number_format($mostrar['valor_a_retirar'],2)."</td>";  
        echo "<td width=200 align='center'>",$mostrar['concepto']."</td>"; 
    }  
    echo "</table>"; 
    
    
    
    
    }
    else { echo' <script>alert("NO EXISTE MOVIMIENTO")</script> ';
        echo "<script>location.href='../paginashtml/main.php'</script>";
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
      }
    
    
    
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function createPDF() {
      var element = document.getElementById('content');
var opt = {
  margin:       1,
  filename:     'extracto.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'Landscape' }
};

// New Promise-based usage:
html2pdf().set(opt).from(element).save();

// Old monolithic-style usage:
html2pdf(element, opt);
    }
</script>	
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>  

