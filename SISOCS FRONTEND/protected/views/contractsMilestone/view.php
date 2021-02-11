<?php
/* @var $this ContractsMilestoneController */
/* @var $model ContractsMilestone */

$this->breadcrumbs=array(
	'Contracts Milestones'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ContractsMilestone', 'url'=>array('index')),
	array('label'=>'Crear ContractsMilestone', 'url'=>array('create')),
	array('label'=>'Actualizar ContractsMilestone', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ContractsMilestone', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ContractsMilestone', 'url'=>array('admin')),
);
?>

<h1>View ContractsMilestone #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'title',
		'description',
		'dueDate',
		'dateMet',
	),
)); ?>
