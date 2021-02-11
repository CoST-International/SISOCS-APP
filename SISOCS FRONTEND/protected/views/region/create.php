<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Region', 'url'=>array('index')),
	array('label'=>'Gestionar Region', 'url'=>array('admin')),
);
?>

<h1>Crear Region</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>