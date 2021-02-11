<?php
/* @var $this ImplementationMilestoneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Implementation Milestones',
);

$this->menu=array(
	array('label'=>'Crear ImplementationMilestone', 'url'=>array('create')),
	array('label'=>'Gestionar ImplementationMilestone', 'url'=>array('admin')),
);
?>

<h1>Implementation Milestones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
