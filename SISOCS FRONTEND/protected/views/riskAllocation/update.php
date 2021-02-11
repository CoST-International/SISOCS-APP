<?php
/* @var $this RiskAllocationController */
/* @var $model RiskAllocation */

$this->breadcrumbs=array(
	'Risk Allocations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar RiskAllocation', 'url'=>array('index')),
	array('label'=>'Crear RiskAllocation', 'url'=>array('create')),
	array('label'=>'View RiskAllocation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar RiskAllocation', 'url'=>array('admin')),
);
?>

<h1>Actualizar RiskAllocation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>