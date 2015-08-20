<?php
require ("fpdf.php");
$pdf=new fpdf();
var_dump(get_class_methods($pdf));
?>