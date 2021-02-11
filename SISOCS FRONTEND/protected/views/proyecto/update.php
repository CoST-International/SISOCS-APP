<?php
/* @var $this ProyectoController */
/* @var $model Proyecto */

$this->breadcrumbs=array(
	'Proyectos'=>array('index'),
	$model->idProyecto=>array('view','id'=>$model->idProyecto),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Proyectos', 'url'=>array('index')),
	array('label'=>'Crear Proyecto', 'url'=>array('create')),
	array('label'=>'Ver Proyecto', 'url'=>array('view', 'id'=>$model->idProyecto)),
	array('label'=>'Gestionar Proyectos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Planificación de Proyecto <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'modelBudgetBreakdown'=>$modelBudgetBreakdown,'modelPrequalification'=>$modelPrequalification,'modelFuentesfinan'=>$modelFuentesFinan)); ?>
