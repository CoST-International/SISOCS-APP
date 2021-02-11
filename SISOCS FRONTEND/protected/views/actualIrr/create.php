<?php
/* @var $this ActualIrrController */
/* @var $model ActualIrr */

$this->breadcrumbs=array(
	'Actual Irrs'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ActualIrr', 'url'=>array('index')),
	array('label'=>'Gestionar ActualIrr', 'url'=>array('admin')),
);
?>

<h1>Crear ActualIrr</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>