<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$documento =$_POST['documento'];
$sendpass = $_POST['sendpass'];
$query =mysqli_query ($conn,"select  sendpass from usuarios where documento='".$documento."'and sendpass= '".$sendpass."'");
$nr= mysqli_num_rows($query);
	if ($nr<1){
    echo "<script> alert('EL CODIGO O DOCUMENTO INGRESADO NO SON CORRECTOS, VERIFIQUE DE NUEVO');window.location= '../login.php' </script>"; 
     
  }else{
    $contraseña=$_POST['contraseña'];
    $confirm = $_POST['confirm'];
    if ($contraseña==$confirm){
      $id=$_POST['id'];
      $contraseña=$_POST['contraseña'];
      $nueva=$_POST['nueva'];
      $contraseña = password_hash($contraseña,PASSWORD_DEFAULT);
   
      $query =mysqli_query ($conn, "INSERT INTO login_usuario Values('".$id."','".$contraseña."','".$nueva."')");
      echo "<script> alert('USUARIO CREADO CON EXITO');window.location= '../login.php' </script>"; 
    }else{
      echo "<script> alert('LAS CONTRASEÑAS NO COINCIDEN');window.location= '../login.php' </script>"; 
    }
       
    }












?>

