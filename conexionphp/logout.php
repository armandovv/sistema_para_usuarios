<?php
@session_start();
$_SESSION = array();
$_SESSION['nameuser'];
// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() -100,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

echo'<script type="text/javascript" language="javascript">

if(confirm("Seguro que quiere salir?")){
   
location.href = "../index.html"}
else 
{
    
  
location.href = "../paginashtml/main.php"}
</script>';


?>