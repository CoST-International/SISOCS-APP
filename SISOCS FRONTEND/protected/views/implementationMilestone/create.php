<?php
/* @var $this ImplementationMilestoneController */
/* @var $model ImplementationMilestone */

$this->breadcrumbs=array(
	'Implementation Milestones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ImplementationMilestone', 'url'=>array('index')),
	array('label'=>'Gestionar ImplementationMilestone', 'url'=>array('admin')),
);
?>

<h1>Crear ImplementationMilestone</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>