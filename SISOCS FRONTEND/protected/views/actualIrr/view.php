<?php
/* @var $this ActualIrrController */
/* @var $model ActualIrr */

$this->breadcrumbs=array(
	'Actual Irrs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ActualIrr', 'url'=>array('index')),
	array('label'=>'Crear ActualIrr', 'url'=>array('create')),
	array('label'=>'Actualizar ActualIrr', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ActualIrr', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ActualIrr', 'url'=>array('admin')),
);
?>

<h1>View ActualIrr #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'title',
		'period_durationInDays',
		'description',
	),
)); ?>
