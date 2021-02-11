<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */

$this->breadcrumbs=array(
	'Prequalifications'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Prequalification', 'url'=>array('index')),
	array('label'=>'Gestionar Prequalification', 'url'=>array('admin')),
);
?>

<h1>Crear Prequalification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>