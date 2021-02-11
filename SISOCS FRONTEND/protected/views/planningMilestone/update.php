<?php
/* @var $this PlanningMilestoneController */
/* @var $model PlanningMilestone */

$this->breadcrumbs=array(
	'Planning Milestones'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar PlanningMilestone', 'url'=>array('index')),
	array('label'=>'Crear PlanningMilestone', 'url'=>array('create')),
	array('label'=>'View PlanningMilestone', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar PlanningMilestone', 'url'=>array('admin')),
);
?>

<h1>Actualizar PlanningMilestone <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>