<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<?php
session_start();

$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');
  if ($mysqli->connect_errno) {
    echo'Error de conexión: ';
	
	exit;
}
else if

(!empty($_SESSION['nameuser']))

{
//echo "la coneccion fue exitosa";
$sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id='".$_SESSION['id']."' and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
$mostrar=mysqli_fetch_array($result);
$sql2= "select id_movimiento, fecha, valor_a_ahorrar, valor_a_retirar, concepto from ahorros inner join login_usuario on login_usuario.id=ahorros.usuario where login_usuario.id='".$_SESSION['id']."'order by fecha desc";

$mysqli->query($sql);
$result=mysqli_query($mysqli, $sql2);

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimientos financieros</title>
    
	<style>
        table {
            width: 100%;
            border-collapse: collapse;

            
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            position: relative;
        }
		th {
  background-color: #f2f2f2;
  cursor: col-resize; /* Cambia el cursor cuando pasas sobre la cabecera */
    text-align:center;
}

        tr:hover {
            background-color:rgb(195, 226, 248);
            cursor: pointer;
        }
        .resizer {
            position: absolute;
            top: 0;
            right: 0;
            width: 10px; /* Aumentamos el ancho para que sea más fácil de capturar */
            height: 100%;
            cursor: col-resize;
            user-select: none;
            z-index: 1; /* Asegura que el área esté por encima del contenido */
            resize: both;
        }

        .calendar-icon {
  border: none;
  background: none;
  font-size: 24px;
  cursor: pointer;
}
.btn-primary{

border-radius: 30px;
}



 </style>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" id="buscador" placeholder="Buscar" aria-label="Search">
     <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
    </form>
    <div>
  <button id="open-calendar" class="calendar-icon" title="Seleccionar fechas">
    <i class="bi bi-calendar"></i>
  </button>
  <input type="date" id="start_date" placeholder="desde" style="display:none;" onchange="filterTable()">
  <input type="date" id="end_date" placeholder="hasta" style="display:none; " onchange="filterTable()">
</div>
<a href='../paginashtml/main.php'> <button class="btn btn-sm btn-primary" type="button">VOLVER A RESUMEN</button></a>
    </div>
   
    </nav>

<table id="tablaDatos">
  <thead>
    <tr>
      <th scope="col">ID MOVIMIENTO<div class="resizer"></div></th>
      <th>FECHA<div class="resizer"></div></th>
      <th>VALOR A AHORRAR<div class="resizer"></div></th>
      <th>VALOR A RETIRAR<div class="resizer"></div></th>
      <th>CONCEPTO<div class="resizer"></div></th>
    </tr>
  </thead>
  <tbody >
    <?php
    if($result->num_rows > 0){
  while($mostrar3=mysqli_fetch_array($result)){
  echo'<tr>';
     echo'<td>'.$mostrar3['id_movimiento'].'</td>';
     echo'<td>'.$mostrar3['fecha'].'</td>';
     echo'<td>'.number_format($mostrar3['valor_a_ahorrar']).'</td>';
     echo'<td>'.number_format($mostrar3['valor_a_retirar']).'</td>';
     echo'<td>'.$mostrar3['concepto'].'</td>';
   echo'</tr>';
  }
    }else{
        header('location: no_encontrado.php?fecha='.$_POST['fecha'].'');
    }
    ?>
     </tbody>
</table>
<script>
        const resizers = document.querySelectorAll(".resizer");
        resizers.forEach(resizer => {
            let startX, startWidth;

            // Detecta el evento inicial al presionar el mouse
            resizer.addEventListener("mousedown", (e) => {
                startX = e.pageX;
                startWidth = resizer.parentElement.offsetWidth;

                // Agrega listeners para mover y detener el redimensionamiento
                document.addEventListener("mousemove", resizeColumn);
                document.addEventListener("mouseup", stopResize);
            });
            function resizeColumn(e) {
                const newWidth = startWidth + (e.pageX - startX);
                if (newWidth > 1) { // Límite mínimo para evitar columnas muy pequeñas
                    resizer.parentElement.style.width = `${newWidth}px`;
                }
            }

            function stopResize() {
                document.removeEventListener("mousemove", resizeColumn);
                document.removeEventListener("mouseup", stopResize);
            }
        });

    </script>
	 <script src="../js/busqueda.js"></script>
   <script src="../js/filterTable.js"></script>
</body>
</html>