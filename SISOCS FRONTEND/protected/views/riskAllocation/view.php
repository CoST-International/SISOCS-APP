<?php
/* @var $this RiskAllocationController */
/* @var $model RiskAllocation */

$this->breadcrumbs=array(
	'Risk Allocations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar RiskAllocation', 'url'=>array('index')),
	array('label'=>'Crear RiskAllocation', 'url'=>array('create')),
	array('label'=>'Actualizar RiskAllocation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar RiskAllocation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar RiskAllocation', 'url'=>array('admin')),
);
?>

<h1>View RiskAllocation #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'description',
		'allocation_party_id',
	),
)); ?>
