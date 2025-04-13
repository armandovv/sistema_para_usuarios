<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mes = $_POST['mes'];
    $id_usuario =$_SESSION['nameuser']; // Ejemplo de ID de usuario

    // Conexión a la base de datos
    $conexion = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

    // Consulta SQL
    $sql = "SELECT fecha, valor_a_ahorrar, valor_a_retirar, concepto
            FROM login_usuario inner join ahorros on ahorros.usuario=login_usuario.id 
            WHERE  login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND MONTH(fecha) = '$mes'";
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
 $sql2= "SELECT sum(valor_a_ahorrar) as suma, sum(valor_a_retirar) as resta from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."' and year(fecha)>= 2025 AND MONTH(fecha) = '$mes'";
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
<style>
  body{

background-color:rgba(216, 232, 169, 0.5);
 background-position: center;
  background-attachment: fixed;
  background-repeat: no-repeat;
  height: 100vh;
  background-size: cover;
}

    .contenedor {
        width: 800px;
        height: 270px;
        margin-left:auto;
        margin-right: auto; /* Centra el contenedor horizontalmente */
        display: flex; /* Coloca los gráficos en una fila */
        justify-content: space-around; /* Espacio entre los gráficos */
        border: 2px solid #ccc; /* Borde alrededor del gráfico */
        padding: 10px; /* Espaciado interno */
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para un efecto elegante */
        background-color: #f9f9f9; /* Fondo claro */
    }
  .contenedor .grafico{
    width: 10px;
    height: 5px;
   }
.btn-primary{
    border-radius: 30px;
}
  </style>
  <a href='../paginashtml/main.php'> <button class="btn btn-sm btn-primary" type="button">VOLVER A RESUMEN</button></a>  
<canvas id="grafica" width="550" height="300" style=" margin-left: auto;margin-right: auto;"></canvas>
<br><br>
<div class="contenedor">
<canvas class="grafico" id="grafica2"></canvas>
<canvas class="grafico" id="grafica3"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafica').getContext('2d');
    const grafica = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($fechas); ?>,
            datasets: [
                {
                    label: 'Total Ahorrado',
                    data: <?php echo json_encode($ahorrados); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Retirado',
                    data: <?php echo json_encode($retirados); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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
        type: 'pie',
        data: {
            labels: <?php echo json_encode($etiquetas); ?>,
            datasets: [{
                label: 'Transacciones',
                data: <?php echo json_encode($transac); ?>,
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
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
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total Retirado',
                    data: <?php echo json_encode($retirado); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

