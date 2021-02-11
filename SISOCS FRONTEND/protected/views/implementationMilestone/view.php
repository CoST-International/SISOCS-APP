<?php
/* @var $this ImplementationMilestoneController */
/* @var $model ImplementationMilestone */

$this->breadcrumbs=array(
	'Implementation Milestones'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ImplementationMilestone', 'url'=>array('index')),
	array('label'=>'Crear ImplementationMilestone', 'url'=>array('create')),
	array('label'=>'Actualizar ImplementationMilestone', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ImplementationMilestone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ImplementationMilestone', 'url'=>array('admin')),
);
?>

<h1>View ImplementationMilestone #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idInicioEjecucion',
		'title',
		'description',
		'dueDate',
		'dateMet',
	),
)); ?>
