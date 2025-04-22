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

$sql= "SELECT distinct sum(valor_a_ahorrar)-sum(valor_a_retirar) as suma, sum(valor_a_retirar) as resta from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."' order by id_movimiento desc limit 1";
$result=mysqli_query($mysqli, $sql);
while ($mostrar=mysqli_fetch_array($result)){
$ahorro =  $mostrar['suma'];
$retiro = $mostrar['resta'];    

 $transac =[$ahorro,$retiro];

$etiquetas =['ahorros','retiros'];
     
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
            header('location: ../conexionphp/ended_sesion.php');
  
            exit();
        
  } else {
    //Activamos sesion tiempo.
    $_SESSION['time'] = time();
  }
  } 
   else{
    echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';
  
    echo "<script>location.href='../index.html'</script>";
  }
  
  
   
  $mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comportamiento financiero</title>
<style>
.container{
width: 800px !important;
height: 700px;


}
.container .btn-primary{

    border-radius: 30px;
}




</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Importar chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>


    <div class="container">
    <h6>Ingresos y gastos usuario <?php echo $_SESSION['id'];?></h6>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
        const etiquetas = <?php echo json_encode($etiquetas) ?>;
        // Podemos tener varios conjuntos de datos. Comencemos con uno
const ahorrado = {  
    label: "ahorros",
    data: <?php echo json_encode($transac) ?>, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
    backgroundColor: ['rgba(30, 132, 73,0.4)',
        'rgba(236, 112, 100,0.4)', ], // Color de fondo
    borderColor: ['rgba(163,221,203,1)',
        'rgba(232,233,161,1)',], // Color del borde
    borderWidth: 2,// Ancho del borde
};

        new Chart($grafica, {
            type: 'pie', // Tipo de gráfica
            data: {
                labels: etiquetas,
                datasets: [
                          ahorrado,
                          
                    // Aquí más datos...
                ]
            },
            options: {
                
                responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        
    </script>
 <form method="POST" action="grafica.php">
    <label for="mes">Selecciona el mes:</label>
    <select name="mes" id="mes">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
        <option value="4">Abril</option>
        <option value="5">Mayo</option>
        <option value="6">Junio</option>
        <option value="7">Julio</option>
        <option value="8">Agosto</option>
        <option value="9">Septiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
    </select>
    <button class="btn btn-sm btn-primary" type="submit">ver comportamiento</button><br>
    <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-primary" type="button">VOLVER A RESUMEN</button></a>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> <br>
    
</body>

</html>
    