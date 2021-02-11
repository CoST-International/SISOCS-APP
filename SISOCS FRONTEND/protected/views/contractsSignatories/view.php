<?php
/* @var $this ContractsSignatoriesController */
/* @var $model ContractsSignatories */

$this->breadcrumbs=array(
	'Contracts Signatories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ContractsSignatories', 'url'=>array('index')),
	array('label'=>'Crear ContractsSignatories', 'url'=>array('create')),
	array('label'=>'Actualizar ContractsSignatories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ContractsSignatories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ContractsSignatories', 'url'=>array('admin')),
);
?>

<h1>View ContractsSignatories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'parties_id',
		'parties_name',
	),
)); ?>
