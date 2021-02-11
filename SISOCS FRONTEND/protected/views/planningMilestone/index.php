<?php
/* @var $this PlanningMilestoneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Planning Milestones',
);

$this->menu=array(
	array('label'=>'Crear PlanningMilestone', 'url'=>array('create')),
	array('label'=>'Gestionar PlanningMilestone', 'url'=>array('admin')),
);
?>

<h1>Planning Milestones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
