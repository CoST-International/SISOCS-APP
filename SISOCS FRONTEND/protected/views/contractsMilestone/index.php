<?php
/* @var $this ContractsMilestoneController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contracts Milestones',
);

$this->menu=array(
	array('label'=>'Crear ContractsMilestone', 'url'=>array('create')),
	array('label'=>'Gestionar ContractsMilestone', 'url'=>array('admin')),
);
?>

<h1>Contracts Milestones</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
