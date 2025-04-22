<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mes = $_POST['mes'];
    $id_usuario =$_SESSION['nameuser']; // Ejemplo de ID de usuario
    setlocale(LC_ALL, 'spanish');
$monthNum  =  $_POST['mes'];
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());

    // Conexión a la base de datos
    $conexion = new mysqli('127.0.0.1','root', '', 'ahorros_familia');
    $sql = "SELECT sum(valor_a_ahorrar) as suma1, sum(valor_a_retirar) as resta1
    FROM login_usuario inner join ahorros on ahorros.usuario=login_usuario.id 
    WHERE  login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND month(fecha) = '$mes'";
$result1 = $conexion->query($sql);

// Preparar datos para Chart.js
$ahorro1 = [];
$retiro1 = [];
while ($fila = $result1->fetch_assoc()) {

$ahorro1[] = $fila['suma1'];
$retiro1[] = $fila['resta1'];
$transac1 =[$ahorro1,$retiro1];

$etiqueta =['total ahorrado','total retirado'];
     
 } 
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);

}

    // Consulta SQL
    $sql = "SELECT fecha, valor_a_ahorrar, valor_a_retirar, concepto
            FROM login_usuario inner join ahorros on ahorros.usuario=login_usuario.id 
            WHERE  login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND month(fecha) = '$mes'";
    $resultado = $conexion->query($sql);

    // Preparar datos para Chart.js
    $fechas = [];
    $ahorrados = [];
    $retirados = [];
    while ($fila = $resultado->fetch_assoc()) {
        $fechas[] = $fila['fecha'];
        $ahorrados[] = $fila['valor_a_ahorrar'];
        $retirados[] = $fila['valor_a_retirar'];
        $conceptos[] = $fila['concepto'];
    }
 $sql2= "SELECT round(sum(valor_a_ahorrar)*100/ (sum(valor_a_ahorrar) + sum(valor_a_retirar))) as suma,round( sum(valor_a_retirar)*100/ (sum(valor_a_ahorrar) +sum( valor_a_retirar))) as resta from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND MONTH(fecha) = '$mes'";
$result=$conexion->query($sql2);
while ($mostrar=mysqli_fetch_array($result)){
$ahorro =  $mostrar['suma'];
$retiro = $mostrar['resta'];    

 $transac =[$ahorro,$retiro];

$etiquetas =['ahorros','retiros'];
     
 } 
}
$sql3 = "SELECT fecha, valor_a_ahorrar, valor_a_retirar, concepto
            FROM login_usuario inner join ahorros on ahorros.usuario=login_usuario.id 
            WHERE  login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND MONTH(fecha) = '$mes'";
    $resultado3 = $conexion->query($sql3);

    // Preparar datos para Chart.js
    $fecha = [];
    $ahorrado = [];
    $retirado = [];
    while ($fila = $resultado3->fetch_assoc()) {
        $fecha[] = $fila['fecha'];
        $ahorrado[] = $fila['valor_a_ahorrar'];
        $retirado[] = $fila['valor_a_retirar'];
        $concepto[] = $fila['concepto'];
    }
?>
<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<style>
  body{

background-color:rgba(216, 232, 169, 0.5);
 background-position: center;
  background-attachment: fixed;
  background-repeat: no-repeat;
  height: 100vh;
  background-size: cover;
}
    h2{
        color: #000000;
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        margin-top: 20px; /* Espacio superior */
        margin-bottom: 20px; /* Espacio inferior */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra del texto */
    }
    .chart-container {
    width: 80%;
    height: 70%;
    position: relative;
}
.grid-stack-item:hover {
    background-color: white;
    border: 2px solid rgba(75, 192, 192, 0.5);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

  


 
.btn-primary{
    border-radius: 30px;
}
.row {
    max-width: 650px; 
  
}
.row .col .p-3{
  
    margin: 0 10px; /* Espacio entre columnas */
    padding: 10px; /* Espacio interno */
    border-radius: 20px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para un efecto elegante */
    max-height: 70px; /* Altura fija para las columnas */
}
  </style>
  <!-- GridStack CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/8.1.0/gridstack.min.css">
<!-- GridStack JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gridstack.js/8.1.0/gridstack-all.min.js"></script>

</head>

 <div style="display: flex; align-items: center; justify-content: space-between;">
    <h2> Resumen de Ahorros y Retiros <?php echo ucwords($monthName);?></h2>
      <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-primary" type="button">VOLVER A RESUMEN</button></a> 
 </div>
  
  <div class="container px-4 text-center">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3" style="background-color:rgba(19, 240, 115, 0.98)" ;><h6>Mis ahorros del mes:<?php echo  ' $'.number_format(array_sum($ahorrados), 2);?></h6> </div>
    </div>
    <div class="col">
      <div class="p-3" style="background-color:rgba(223, 45, 45, 0.87)"><h6>He gastado en el mes: <?php echo  ' $'.number_format(array_sum($retirados), 2);?></h6></div>
    </div>
  </div>
</div>
<br>
<div class="grid-stack">
    <!-- Primer gráfico -->
    <div class="grid-stack-item" gs-w="4" gs-h="3">
        <div class="chart-container">
            <canvas id="grafica1"></canvas>
        </div>
    </div>

    <!-- Segundo gráfico -->
    <div class="grid-stack-item" gs-w="6" gs-h="3">
        <div class="chart-container">
            <canvas id="grafica"></canvas>
        </div>
    </div>

    <!-- Tercer gráfico -->
    <div class="grid-stack-item" gs-w="3" gs-h="3">
        <div class="chart-container">
            <canvas id="grafica2"></canvas>
        </div>
    </div>

    <!-- Cuarto gráfico -->
    <div class="grid-stack-item" gs-w="5" gs-h="3">
        <div class="chart-container">
            <canvas id="grafica3"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
     const ctx1 = document.getElementById('grafica1').getContext('2d');
     
     const grafica1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($etiqueta); ?>,
            datasets: [{
                label: 'Movimientos del mes',
                data: <?php echo json_encode($transac1); ?>,
                backgroundColor: [
                    'rgba(19, 240, 115, 0.98)',
                    'rgba(223, 45, 45, 0.87)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins:{
                
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': $' +  new Intl.NumberFormat().format(tooltipItem.raw);
                        }
                    }
                },

            },
        }
       
       


    });
    const ctx = document.getElementById('grafica').getContext('2d');
    const grafica = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($fechas); ?>,
            datasets: [
                {
                    label: 'Ahorros',
                    data: <?php echo json_encode($ahorrados); ?>,
                    backgroundColor: 'rgba(28, 195, 218, 0.92)',
                    borderColor: 'rgb(139, 238, 19)',
                    borderWidth: 1
                },
                {
                    label: 'Retiros',
                    data: <?php echo json_encode($retirados); ?>,
                    backgroundColor: 'rgba(225, 2, 39, 0.96)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    const ctx2 = document.getElementById('grafica2').getContext('2d');
   
 const grafica2 = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($etiquetas); ?>,
            datasets: [{
                label: 'Transacciones',
                data: <?php echo json_encode($transac); ?>,
                backgroundColor: [
                    'rgba(19, 240, 115, 0.98)',
                    'rgba(223, 45, 45, 0.87)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                        }
                    }
                },
                color:'#ffffff',
                font:{
                    size: 33,// Cambia el tamaño de la fuente aquí
                    weight: 'bold' // Cambia el peso de la fuente aquí
                },
                backgroundColor: 'rgba(255, 255, 255, 0.8)', 
                boorderRadius:5,
                padding: 6,
                anchor:'center',
                align:'center',// Color de fondo del tooltip
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Transacciones Totales'
                }
            }
        }
    });
 
 const ctx3 = document.getElementById('grafica3').getContext('2d');
    const grafica3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($concepto); ?>,
            datasets: [
                {
                    label: 'Total Ahorrado',
                    data: <?php echo json_encode($ahorrado); ?>,
                    backgroundColor: 'rgba(42, 151, 235, 0.9)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Retirado',
                    data: <?php echo json_encode($retirado); ?>,
                    backgroundColor: 'rgba(233, 115, 56, 0.89)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
    
  
</script>
<script>
    const grid = GridStack.init();
    function resizeCharts() {
        document.querySelectorAll('.chart-container canvas').forEach(canvas => {
            const chartInstance = Chart.getChart(canvas.id);
            if (chartInstance) {
                chartInstance.resize();
            }
        });
    }
    grid.on('change', resizeCharts);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
