<?php
/* @var $this ContractsMilestoneController */
/* @var $model ContractsMilestone */

$this->breadcrumbs=array(
	'Contracts Milestones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ContractsMilestone', 'url'=>array('index')),
	array('label'=>'Gestionar ContractsMilestone', 'url'=>array('admin')),
);
?>

<h1>Crear ContractsMilestone</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>