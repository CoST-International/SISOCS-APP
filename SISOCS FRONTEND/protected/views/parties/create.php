<?php
/* @var $this PartiesController */
/* @var $model Parties */

$this->breadcrumbs=array(
	'Parties'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Parties', 'url'=>array('index')),
	array('label'=>'Gestionar Parties', 'url'=>array('admin')),
);
?>

<h1>Crear Parties</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>