<?php
/* @var $this TipoGarantiasController */
/* @var $model TipoGarantias */

$this->breadcrumbs=array(
	'Tipo Garantiases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar TipoGarantias', 'url'=>array('index')),
	array('label'=>'Gestionar TipoGarantias', 'url'=>array('admin')),
);
?>

<h1>Crear TipoGarantias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>