<?php
/* @var $this DocumentTypesController */
/* @var $model DocumentTypes */

$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar DocumentTypes', 'url'=>array('index')),
	array('label'=>'Gestionar DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>Crear DocumentTypes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>