<?php
session_start();

$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (($conn->connect_error)) {
	echo "lo sentimos, este sitio web esta experimentando problemas.";
	
	exit;
}
else if
(!empty($_SESSION['nameuser']))

{
$sql="select*from login_usuario inner join usuarios on usuarios.documento = login_usuario.id where '".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."' ";
$result=mysqli_query($conn, $sql);
if($result->num_rows > 0){
$mostrar=mysqli_fetch_array($result);
// Función para ocultar los primeros dígitos del número de documento
function maskDocumentNumber($documento) {
  
  $maskLength = strlen($documento) - 5;
  return str_repeat('*', $maskLength) . substr($documento, -5);
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
            header('location: ended_sesion.php');
  
            exit();
        
  } else {
    //Activamos sesion tiempo.
    $_SESSION['time'] = time();
  }
  }    

}else {
    echo '<script>alert("SE CERRO LA SESION DE FORMA INESPERADA")</script> ';
  
    echo "<script>location.href='../index.html'</script>";
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contraseña = $_POST['contraseña'];
    $id = $_SESSION['id']; // Asumiendo que el ID del usuario está almacenado en la sesión

    // Consulta para verificar la contraseña
    $sql = "SELECT contraseña FROM login_usuario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verificar la contraseña ingresada
    if (password_verify($contraseña, $hashed_password)) {
        // Contraseña correcta, redirigir al formulario de actualización
        header("Location: ../paginashtml/actualizar_datos.php");
        exit();
    } else {
        echo'<script>alert("CONTRASEÑA INCORRECTA")</script>';
        echo "<script>location.href='perfil.php'</script>";
    }
}
?>