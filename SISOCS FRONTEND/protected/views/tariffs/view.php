<?php
/* @var $this TariffsController */
/* @var $model Tariffs */

$this->breadcrumbs=array(
	'Tariffs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Tariffs', 'url'=>array('index')),
	array('label'=>'Crear Tariffs', 'url'=>array('create')),
	array('label'=>'Actualizar Tariffs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Tariffs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Tariffs', 'url'=>array('admin')),
);
?>

<h1>View Tariffs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idInicioEjecucion',
		'tittle',
		'paidBy_party_id',
		'startDate',
		'endDate',
		'maxExtentDate',
		'durationInDays',
		'notes',
		'dimensions',
		'amount',
		'currency',
	),
)); ?>
