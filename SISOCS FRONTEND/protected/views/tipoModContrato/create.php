<?php
/* @var $this TipoModContratoController */
/* @var $model TipoModContrato */

$this->breadcrumbs=array(
	//'Tipo Mod Contratos'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar TipoModContrato', 'url'=>array('index')),
	array('label'=>'Gestionar TipoModContrato', 'url'=>array('admin')),
);
?>

<h1>Crear TipoModContrato</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
