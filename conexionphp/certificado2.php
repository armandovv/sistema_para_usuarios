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
$sql="SELECT distinct
    id, nombres,
    min(fecha)
    
FROM 
    ahorros a
INNER JOIN 
    usuarios u ON u.documento= a.usuario
INNER JOIN 
    login_usuario l ON a.usuario = l.id
    where id='".$_SESSION['id']."'and nombres='".$_SESSION['nameuser']."'";
$result=mysqli_query($mysqli, $sql);
$mostrar=mysqli_fetch_array($result);

setlocale(LC_TIME, "spanish");
$pdf = new TCPDF();

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Certificado de producto');
$pdf->SetSubject('Asunto del PDF');
$pdf->SetKeywords('TCPDF, PDF, ejemplo, prueba');

// Establecer las propiedades del documento
$pdf->SetHeaderData('', 0, 'SISTEMA DE INFORMACION AHORRO FAMILIAR');
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
            text-align: center;
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
$textY = $y + $imgHeight + 200; // Ajusta el valor 10 mm según la separación deseada

$imagePath1 = '../images/firma.jpeg';
list($imgWidth1, $imgHeight1) = getimagesize($imagePath1);
$imgWidth1 = 50; // Ancho en mm
$imgHeight1 = 20; // Alto en m
$pageWidth1 = $pdf->getPageWidth();
$pageHeight1 = $pdf->getPageHeight();
// Calcular las coordenadas X e Y para centrar la imagen
$a = ($pageWidth1 - $imgWidth1) / 8; // Centrar horizontalmente
$b = 179; //
$pdf->Image($imagePath1, $a, $b, $imgWidth1, $imgHeight1, '', '', 'T', true, 300, '', false, false, 0, false, false, false);
$textA = $a + 22;
// Ajustar la posición del contenido HTML para que comience debajo de la imagen
$pdf->SetY($textY);
$pdf->SetY($textA); // ajusta la posición vertical para el texto

// Configurar el texto

$html = $css . '
<p></p> <p></p> <p></p> 
<h1>Certificado</h1>
<p>Por medio de la presente, hacemos constar, que el(la) señor(a)<strong> ' .htmlspecialchars(ucwords($mostrar['nombres'])).'</strong>
con documento de identificacion N.<strong>' .$mostrar['id'].'</strong>:</p>
<p>Posee sus ahorros en nuestro sistema desde la fecha '.$mostrar['min(fecha)'].'.</p>

<p>Se expide este certificado a solicitud del interesado el dia '.utf8_encode(strftime("%A %d de %B del %Y")).'
</p>
<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>

Cordialmente:
<p></p><p></p>
<p></p><p></p>
Jorge Armando Varela
<p>Administrador financiero</p><p></p><p></p><p></p>
<p><strong>SISTEMA DE INFORMACION AHORRO FAMILIAR</strong></p>




';
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el archivo PDF
$pdf->Output('certificacion'.$_SESSION['id'].date('Y-m-d-H:i:s').'.pdf', 'I');
}
?>
