<?php
/* @var $this RiskAllocationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Risk Allocations',
);

$this->menu=array(
	array('label'=>'Crear RiskAllocation', 'url'=>array('create')),
	array('label'=>'Gestionar RiskAllocation', 'url'=>array('admin')),
);
?>

<h1>Risk Allocations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
