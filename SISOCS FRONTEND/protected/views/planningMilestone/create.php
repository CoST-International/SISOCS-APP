<?php
/* @var $this PlanningMilestoneController */
/* @var $model PlanningMilestone */

$this->breadcrumbs=array(
	'Planning Milestones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar PlanningMilestone', 'url'=>array('index')),
	array('label'=>'Gestionar PlanningMilestone', 'url'=>array('admin')),
);
?>

<h1>Crear PlanningMilestone</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
