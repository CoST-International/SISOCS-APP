<?php
/* @var $this EntesUnidadController */
/* @var $model EntesUnidad */

$this->breadcrumbs=array(
	//'Entes Unidads'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar EntesUnidad', 'url'=>array('index')),
	array('label'=>'Gestionar EntesUnidad', 'url'=>array('admin')),
);
?>

<h1>Crear EntesUnidad</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
