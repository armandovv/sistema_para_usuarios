<?php
session_start();
// Incluir la librería PhpSpreadsheet
require ('../vendor/autoload.php');  // Si estás usando Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

// Crear una nueva hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Conectar a la base de datos (ajusta a tu configuración)
$mysqli = new mysqli('127.0.0.1','root', '', 'ahorros_familia');

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}
else if

(!empty($_SESSION['nameuser'])){

// Consultar los datos de la base de datos
$fecha = $_POST['fecha'];
$usuario= $_POST['usuario'];
$query = "select id_movimiento, fecha, valor_a_ahorrar, valor_a_retirar, concepto from ahorros inner join usuarios on usuarios.documento= ahorros.usuario where year(fecha)= 2024 and month(fecha)='".$fecha."'and usuario ='".$usuario."'";// Ajusta la consulta
$result =mysqli_query($mysqli, $query);

// Verificar si hay resultados

    // Establecer encabezados de la hoja de Excel
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Fecha');
    $sheet->setCellValue('C1', 'ahorro');
    $sheet->setCellValue('D1', 'retiros');
    $sheet->setCellValue('E1', 'concepto');

    // Escribir los datos en las celdas
    $row = 2;
    if($result->num_rows > 0){// Empezamos en la segunda fila para los datos
    while ($data=mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['id_movimiento']);
        $sheet->setCellValue('B' . $row, $data['fecha']);
        $sheet->setCellValue('C' . $row, $data['valor_a_ahorrar']);
        $sheet->setCellValue('D' . $row, $data['valor_a_retirar']);
        $sheet->setCellValue('E' . $row, $data['concepto']);
        $row++;
    }

    // Dar formato a las celdas (opcional)
    $sheet->getStyle('A1:E1')->getFont()->setBold(true);
    $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:E' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
    
    // Establecer el nombre del archivo de descarga
    $fileName = 'movimientos_' .date('Y-m-d_H-i-s').'.xlsx';

    // Crear el escritor de Excel
    $writer = new Xlsx($spreadsheet);

    // Establecer el tipo de cabecera para forzar la descarga
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');

    // Guardar el archivo en la salida para que se descargue
    $writer->save('php://output');
} else {
    echo "No se encontraron datos.";
}
}
// Cerrar la conexión a la base de datos
$mysqli->close();

?>
