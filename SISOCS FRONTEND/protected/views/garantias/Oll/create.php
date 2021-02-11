<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantiases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	array('label'=>'Gestionar Garantias', 'url'=>array('admin')),
);
?>

<h1>Crear Garantias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>