<?php
/* @var $this CalificacionController */
/* @var $model Calificacion */

$this->breadcrumbs=array(
	'Calificaciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Calificaciones', 'url'=>array('index')),
	array('label'=>'Gestionar Calificaciones', 'url'=>array('admin')),
);
?>

<h1>Crear Invitaci&oacute;n y Calificaci&oacuten</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
