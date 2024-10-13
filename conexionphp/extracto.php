<?php
session_start();
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php'); // Ajusta el path según tu configuración
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');
  if ($mysqli->connect_errno) {
    echo'Error de conexión: ';
	
	exit;
}
else if

(!empty($_SESSION['nameuser']))

{
//echo "la coneccion fue exitosa";

$fecha = $_POST['fecha'];
$sql= "select id, nombres from login_usuario inner join usuarios on usuarios.documento=login_usuario.id where login_usuario.id='".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
$mostrar=mysqli_fetch_array($result);

$fecha = $_POST['fecha'];
$sql = "select distinct month(fecha) from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
setlocale(LC_ALL, 'spanish');
$monthNum  = $fecha;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = strftime('%B', $dateObj->getTimestamp());
$sql1 = "SELECT sum(valor_a_retirar) from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where  year(fecha)>= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$sql2="select sum(valor_a_ahorrar)-sum(valor_a_retirar) as saldo from login_usuario inner join ahorros on ahorros.usuario=login_usuario.id where login_usuario.id='".$_SESSION['id']."'";
$result1=mysqli_query($mysqli, $sql1);
$result2=mysqli_query($mysqli, $sql2);

$mostrar1=mysqli_fetch_array($result1);
$mostrar2=mysqli_fetch_array($result2);
$sql3 = "select *from login_usuario inner join ahorros on ahorros.usuario= login_usuario.id where year(fecha)= 2024 and month(fecha)='".$fecha."' and login_usuario.id='".$_SESSION['id']."'";
$result3=mysqli_query($mysqli, $sql3); 

// Crear una instancia de TCPDF
$pdf = new TCPDF();

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('extracto '.$monthName.'');
$pdf->SetSubject('Asunto del PDF');
$pdf->SetKeywords('TCPDF, PDF, ejemplo, prueba');

// Establecer las propiedades del documento
$pdf->SetHeaderData('', 0, 'SISTEMA DE INFORMACION AHORRO FAMILIAR', 'Extracto mes '.$monthName.' ');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Configurar márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Establecer el formato de página
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Agregar una página
$pdf->AddPage();


// Estilo CSS para el PDF
$css = '
    <style>
      h1 {
            color: #0044cc;
            font-size: 20px;
            text-align: left;
        }
        p {
            color: #333333;
            font-size: 11px;
            line-height: 1;
        }
        .highlight {
            background-color: #ffff00;
            padding: 5px;
        }
       table td{
          font-size: 11px;
}  
    </style>
';

$imagePath = '../images/logo corp1.png';
$imgWidth = 50; // Ancho en mm
$imgHeight = 20; // Alto en m
$pageWidth = $pdf->getPageWidth();
$pageHeight = $pdf->getPageHeight();
// Calcular las coordenadas X e Y para centrar la imagen
$x = ($pageWidth - $imgWidth) / 2; // Centrar horizontalmente
$y = 20; // Distancia desde la parte superior (ajusta según necesidad)

// Incluir la imagen en el PDF
$pdf->Image($imagePath, $x, $y, $imgWidth, $imgHeight, '', '', 'T', true, 300, '', false, false, 0, false, false, false);
$textY = $y + $imgHeight + 1; // Ajusta el valor 10 mm según la separación deseada

// Ajustar la posición del contenido HTML para que comience debajo de la imagen
$pdf->SetY($textY);
$html = $css . '
  
<h1>Apreciado Cliente</h1>
<p> '.htmlspecialchars(ucwords($mostrar['nombres'])).'</p>
<p><strong>Documento</strong> </p>
<p> '.htmlspecialchars($mostrar['id']).'</p>
<p>TOTAL RETIRADO EN EL MES <strong>$'.number_format($mostrar1['sum(valor_a_retirar)'],1).'</strong></p>
<p>TOTAL AHORRADO <strong>$'.number_format($mostrar2['saldo'],1).'</strong></p>
';


$tableHtml = '
    <h2><strong>MOVIMIENTOS ' .strtoupper($monthName). '</strong></h2>
    <table border="1" cellpadding="4" cellspacing="0" align="center">
        <thead>
            <tr>
                <th style="background-color:#f2f2f2;">MOVIMIENTO</th>
                <th style="background-color:#f2f2f2;">FECHA</th>
                <th style="background-color:#f2f2f2;">AHORRO</th>
                <th style="background-color:#f2f2f2;">RETIROS</th>
                <th style="background-color:#f2f2f2;">CONCEPTO</th>
            </tr>
        </thead>
        <tbody>';
        if($result3->num_rows > 0){
        while ($mostrar3=mysqli_fetch_array($result3)) {
          $tableHtml .= '<tr>';
          $tableHtml .= '<td>' . $mostrar3['id_movimiento']. '</td>';
          $tableHtml .= '<td>' . htmlspecialchars($mostrar3['fecha']) . '</td>';
          $tableHtml .= '<td>' .number_format($mostrar3['valor_a_ahorrar'],1). '</td>';
          $tableHtml .= '<td>'.number_format($mostrar3['valor_a_retirar'],1). '</td>';
          $tableHtml .= '<td>' . htmlspecialchars($mostrar3['concepto']) . '</td>';
          $tableHtml .= '</tr>';
      
        }
      $tableHtml .= '</tbody></table>';
        
      // Concatenar el HTML existente con el HTML de la tabla
      $fullHtml = $html . $tableHtml;

        
// Escribir el contenido en el PDF
$pdf->writeHTML($fullHtml, true, false, true, false, '');
$numeroDocumento = $_SESSION['id']; // Usa el número de documento como contraseña
$pdf->SetProtection(array('copy', 'print'), $numeroDocumento, null);
// Cerrar y generar el archivo PDF
$pdf->Output('extracto'.$_SESSION['id'].date('Y-m-d-H:i:s').'.pdf', 'D'); // 'I' para enviar el archivo al navegador


}else{

  header('location: no_encontrado.php?fecha='.$fecha.'');
}
}
$mysqli->close();
?>



