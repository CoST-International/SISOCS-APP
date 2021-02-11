<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Locality', 'url'=>array('index')),
	array('label'=>'Gestionar Locality', 'url'=>array('admin')),
);
?>

<h1>Crear Locality</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>