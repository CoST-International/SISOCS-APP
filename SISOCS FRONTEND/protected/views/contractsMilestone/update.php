<?php
/* @var $this ContractsMilestoneController */
/* @var $model ContractsMilestone */

$this->breadcrumbs=array(
	'Contracts Milestones'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ContractsMilestone', 'url'=>array('index')),
	array('label'=>'Crear ContractsMilestone', 'url'=>array('create')),
	array('label'=>'View ContractsMilestone', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ContractsMilestone', 'url'=>array('admin')),
);
?>

<h1>Actualizar ContractsMilestone <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>