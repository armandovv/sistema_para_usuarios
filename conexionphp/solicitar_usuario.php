<?php
$dbhost= "127.0.0.1";
$dbuser="root";
$dbpass="";
$dbname="ahorros_familia";
$conn= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn)
  {echo " LO SENTIMOS, ESTE SITIO WEB ESTA EXPERIMENTANDO PROBLEMAS  <BR>";
	echo "error: Fallo al conectarse a mysql debido a : <br>";
		echo"errno: " . $mysqli->connect_errno . "<br>";
	exit;}
    $documento = $_POST['documento'];	
	$length = (int)$_POST['chars'];


	
	$query =mysqli_query ($conn,"select *from usuarios where documento='".$documento."'");
	$nr= mysqli_num_rows($query);
	if ($nr<1)
	{ echo '<script>alert("EL DOCUMENTO INGRESADO NO SE ENCUENTRA REGISTRADO EN NUESTRA BASE DE DATOS")</script> ';
		
        echo "<script>location.href='../login.html'</script>";
		
		}else{
            $documento = $_POST['documento'];
            $length = (int)$_POST['chars'];	
            $query =mysqli_query ($conn,"select id, email, nombres, contraseña from usuarios inner join login_usuario on login_usuario.id = usuarios.documento where documento= '".$documento."'");
            $nr= mysqli_num_rows($query);
        if($nr==1){
                echo '<script>alert("Usted ya se encuentra registrado en nuestro sistema. Por favor verifique e intente de nuevo.")</script> ';
		
                echo "<script>location.href='../login.html'</script>";
                

               }else{
                $queryuser =mysqli_query ($conn,"select *from usuarios where documento='".$documento."'");

                $mostrar= mysqli_fetch_array($queryuser); 
                function generatePassword($length)
                {
                    $key = "";
                    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
                    //$pattern = "1234567890abcdefghijklmñnopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.-_*/=[]{}#@|~¬&()?¿";
                    $max = strlen($pattern)-1;
                    for($i = 0; $i < $length; $i++){
                        $key .= substr($pattern, mt_rand(0,$max), 1);
                    }
                    return $key;
                }
                $sendpass 	= generatePassword($length);
                $nombres = $mostrar['nombres'];
                $paracorreo =$mostrar['email'];
                $titulo				= "Recuperar clave de acceso";
                $mensaje			= "Hola $nombres
                                      Ingresa con el codigo $sendpass y procede a crear tu usuario con clave nueva.
                                        cordialmente
                                        Sistema de informacion ahorro familiar";
                $tucorreo			= "From: varelaarmando430@gmail.com";
                
                (mail($paracorreo,$titulo,$mensaje,$tucorreo));
                
                    $queryuser =mysqli_query($conn,"update login_usuario inner join usuarios on usuarios.documento = login_usuario.id set sendpass = '".$sendpass."' where documento= '".$documento."'");
                
                    echo "<script> alert('Se envio codigo de recuperacion al correo ".$mostrar['email']."') </script>";

               } }
?>           
	<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css ">
   <style>
 form{
    
    padding-top: 90px;
    
}
.mb-3{
	max-width: 550px;
    margin-left: auto;
    margin-right: auto;
    padding: 1.5em;
   
}
.col-auto{
	max-width: 550px;
    margin-left: auto;
    margin-right: auto;
    padding: 1.5em;

}
.col-auto .btn-primary{
	width: 100%;
    background-color: blue;
    border: 0;
    text-transform: uppercase;
    padding: 1em;
    font-size: 1em;
    letter-spacing: .1em;
    border-radius: .3em;
}



	</style>
	<script>
 window.addEventListener("load", function() {

// icono para mostrar contraseña
showPassword = document.querySelector('.show-password');
showPassword.addEventListener('click', () => {

	// elementos input de tipo clave
	password1 = document.querySelector('.password1');
	password2 = document.querySelector('.password2');

	if ( password1.type === "text" ) {
		password1.type = "password"
		password2.type = "password"
		showPassword.classList.remove('fa-eye-slash');
	} else {
		password1.type = "text"
		password2.type = "text"
		showPassword.classList.toggle("fa-eye-slash");
	}

})

});

	</script>
</head>
<body>
<h2>POR FAVOR LLENE TODOS LOS DATOS PARA CREAR SU USUARIO</h2>
<table>
<form action="update_pass.php" method="POST" onsubmit="return validar()">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Ingrese el codigo enviado a su correo</label>
  <input type="text" class="form-control" name="enviarpass" id="exampleFormControlInput1" required>

</div>
<div class="mb-3">
<label for="inputPassword" class="form-label">ingrese una contraseña nueva</label>
<input type="password" id="inputPassword" class="form-control  password1" name="contraseña"  required  pattern=".{6,}" title="Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros">
<span class="fa fa-fw fa-eye password-icon show-password"></span>
<div id="passwordHelpBlock" class="form-text">
 Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros, no pueden haber espacios.
</div>
</div>
<div class="mb-3">
<label for="inputPassword5" class="form-label">confirme su contraseña</label>
<input type="password" id="inputPassword5" class="form-control  password2" name="confirm" required pattern=".{6,}" title="Su contraseña debe tener 6 o mas caracteres, puede incluir letras y numeros">
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Cambiar</button>
  </div>
</form>


	</table>
	<script src="../js/comparepass.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> 
</body>
</html>
	
			
			
		
		
	


	
	
	
        

