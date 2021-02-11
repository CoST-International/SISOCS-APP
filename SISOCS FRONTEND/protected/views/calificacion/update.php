<?php
/* @var $this CalificacionController */
/* @var $model Calificacion */

$this->breadcrumbs=array(
	'Calificaciones'=>array('index'),
	$model->idCalificacion=>array('view','id'=>$model->idCalificacion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Calificaciones', 'url'=>array('index')),
	array('label'=>'Crear Calificación', 'url'=>array('create')),
	array('label'=>'Ver Calificación', 'url'=>array('view', 'id'=>$model->idCalificacion)),
	array('label'=>'Gestionar Calificaciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Invitación y Calificación <?php echo $model->numproceso; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>