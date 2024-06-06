<?php
// Iniciar sesión
session_start();
 
// Conexión a la base de datos
$db = mysqli_connect('127.0.0.1', 'root', '', 'ahorros_familia');
 
$errors = [];

// Si se ha enviado el formulario
if (isset($_POST['login_button'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);
 
  // Comprobar si el nombre de usuario es válido
  $query = "select id, nombres, contraseña from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id= '".$id."'";
  $results = mysqli_query($db, $query);
 
  if (mysqli_num_rows($results) == 1) {
    // Nombre de usuario válido, verificar contraseña
    $row = mysqli_fetch_assoc($results);
    if (password_verify($contraseña, $row['contraseña'])) {
      // Inicio de sesión válido
      $_SESSION['id'] = $id;
	
	
	
			
	
			/* la columna uno corresponde con la columna del nombre completo */
			$nameuser = $row['nombres'];
	
			/* Podrías guardarlo como variable de sesión */
			
      $_SESSION['nameuser'] = $nameuser;
      $_SESSION['time'] = time();
      header('location: ./paginashtml/main.php');
    } else {
      // Contraseña inválida
      $errors[] = "Documento/contraseña inválidos";
    }
  } else {
    // Nombre de usuario inválido
    $errors[] = "Documento/contraseña inválidos";
  }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesion</title>
  <link rel="icon" href="./images/favicon.ico">
  <link rel="stylesheet" href="./css/stylelogin.css" />
  <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;1,100;1,200&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<video autoplay="true" muted="true" loop="true"> <source src="./images/videov.mp4" type="video/mp4"></video>
<br><br>
  <div class="caja_popup" id="formrecuperar">
   
    <form action="./conexionphp/recuperar.php" class="contenedor_popup" method="POST">
          <table>
      <tr><th colspan="2">Recuperar contraseña</th></tr>
              <tr> 
                  <td><b> Documento</b></td>
                  <td><input type="text" name="documento" required class="cajaentradatexto"></td>
                  <input class="form-control" type="hidden" name="charset" value="8" maxlength="1">
              </tr>
              <tr> 	
                 <td colspan="2">
             <button type="button" onclick="cancelarform()" class="txtrecuperar">Cancelar</button>
             <input class="txtrecuperar" type="submit" name="btnrecuperar" value="Enviar" onClick="javascript: return confirm('¿Deseas enviar tu contraseña a tu correo?');">
        </td>
              </tr>
          </table>
      </form>
    </div>
    <div class="caja_popup" id="formcrear">
      <form action="./conexionphp/solicitar_usuario.php" class="contenedor_popup" method="POST">
            <table>
        <tr><th colspan="2">Ingrese su documento para solicitar usuario con contraseña</th></tr>
                <tr> 
                    <td><b> Documento</b></td>
                    <td><input type="text" name="documento" required class="cajaentradatexto"></td>
                    <input class="form-control" type="hidden" name="chars" value="8" maxlength="1">
                </tr>
                <tr> 	
                   <td colspan="2">
               <button type="button" onclick="cancelarform1()" class="txtrecuperar">Cancelar</button>
               <input class="txtrecuperar" type="submit" name="btnrecuperar" value="Enviar" onClick="javascript: return confirm('Enviar codigo para crear contraseña a tu correo?');">
          </td>
                </tr>
            </table>
        </form>
      </div>
      <section class="sect">
  <div class="content">
    <h1 class="logo"><span>INICIO DE SESION</span></h1>
    <?php
              if (count($errors) > 0) {
                echo "<div class='alert alert-danger' role='alert'>";
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                echo "</div>";
              }
              ?>

    <div class="contact-wrapper">
      <!-- FORMULARIO -->
      <div class="contact-form">
        <!-- <h3>Contactanos</h3> -->
        <form action="login.php" method="post">
          <p>
            <label for="fullname">DOCUMENTO</label>
            <input type="text" name="id" id="id" required/>
          </p>

          <p>
            <label for="email">CONTRASEÑA</label>
            <input type="password" name="contraseña" id="contraseña" required/>
          </p>
          <p class="block">
            <a class="ref" onclick="abrirform()">Olvidó su contraseña?</a><br>
            <a class="ref" onclick="openwindow()">Registrese</a>
            <button name="login_button" type="submit">Entrar</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  </section>
  <script src="./js/recuperar.js"></script>
  <script src="./js/crear.js"></script>
 
</body>
</html>