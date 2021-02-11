<?php
/* @var $this RiskAllocationController */
/* @var $model RiskAllocation */

$this->breadcrumbs=array(
	'Risk Allocations'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar RiskAllocation', 'url'=>array('index')),
	array('label'=>'Gestionar RiskAllocation', 'url'=>array('admin')),
);
?>

<h1>Crear RiskAllocation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>