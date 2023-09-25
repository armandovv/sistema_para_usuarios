<?php
header("Content-disposition: attachment; filename=certificado.pdf");
header("Content-type: application/pdf");
readfile("certificado.pdf");
?>