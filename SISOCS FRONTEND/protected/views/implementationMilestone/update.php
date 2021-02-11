<?php
/* @var $this ImplementationMilestoneController */
/* @var $model ImplementationMilestone */

$this->breadcrumbs=array(
	'Implementation Milestones'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ImplementationMilestone', 'url'=>array('index')),
	array('label'=>'Crear ImplementationMilestone', 'url'=>array('create')),
	array('label'=>'View ImplementationMilestone', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ImplementationMilestone', 'url'=>array('admin')),
);
?>

<h1>Actualizar ImplementationMilestone <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>