<?php
/* @var $this ActualIrrController */
/* @var $model ActualIrr */

$this->breadcrumbs=array(
	'Actual Irrs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ActualIrr', 'url'=>array('index')),
	array('label'=>'Crear ActualIrr', 'url'=>array('create')),
	array('label'=>'View ActualIrr', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ActualIrr', 'url'=>array('admin')),
);
?>

<h1>Actualizar ActualIrr <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>