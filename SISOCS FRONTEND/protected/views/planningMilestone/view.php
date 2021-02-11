<?php
/* @var $this PlanningMilestoneController */
/* @var $model PlanningMilestone */

$this->breadcrumbs=array(
	'Planning Milestones'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar PlanningMilestone', 'url'=>array('index')),
	array('label'=>'Crear PlanningMilestone', 'url'=>array('create')),
	array('label'=>'Actualizar PlanningMilestone', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar PlanningMilestone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar PlanningMilestone', 'url'=>array('admin')),
);
?>

<h1>View PlanningMilestone #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProyecto',
		'title',
		'description',
		'dueDate',
		'dateMet',
	),
)); ?>
