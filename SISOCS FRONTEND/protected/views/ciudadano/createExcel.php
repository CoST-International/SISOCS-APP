
<?php
print_r('hola');
require_once 'functions/excel.php';

activeErrorReporting();
noCli();

require_once 'PHPExcel/PHPExcel.php';
require_once 'functions/conexion.php';
require_once 'functions/getAll.php';

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Daniel Pineda")
               ->setLastModifiedBy("Daniel Pineda")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("descripción")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Archivos resultantes de la prueba");

$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
                                          ->setSize(10);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Lista reproducción')
            ->setCellValue('B1', 'Vídeo')
            ->setCellValue('C1', 'Duración');

$informe = getAllListsAndVideos();
$i = 2;
while($row = $informe->fetch_array(MYSQLI_ASSOC))
{
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue("A$i", $row['idCalificacion'])
            ->setCellValue("B$i", $row['idProyecto'])
            ->setCellValue("C$i", $row['numproceso']);
$i++;
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->setTitle('Informe de vídeos');

$objPHPExcel->setActiveSheetIndex(0);

getHeaders();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>
