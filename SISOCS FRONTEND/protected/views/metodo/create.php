<?php
/* @var $this MetodoController */
/* @var $model Metodo */

$this->breadcrumbs=array(
	'Metodos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Metodo', 'url'=>array('index')),
	array('label'=>'Gestionar Metodo', 'url'=>array('admin')),
);
?>

<h1>Crear Metodo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>