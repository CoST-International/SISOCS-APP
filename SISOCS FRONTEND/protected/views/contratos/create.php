<?php
/* @var $this ContratosController */
/* @var $model Contratos */

$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Modificaciones', 'url'=>array('index')),
	array('label'=>'Gestionar Modificaciones', 'url'=>array('admin')),
);
?>

<h1>Crear una modificación de contrato</h1>

<?php 

$this->renderPartial('_form', array('model'=>$model)); 


?>