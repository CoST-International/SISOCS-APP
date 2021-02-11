<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */

$this->breadcrumbs=array(
	'Prequalifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Prequalification', 'url'=>array('index')),
	array('label'=>'Crear Prequalification', 'url'=>array('create')),
	array('label'=>'Actualizar Prequalification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Prequalification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Prequalification', 'url'=>array('admin')),
);
?>

<h1>View Prequalification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProyecto',
		'startDate',
		'endDate',
		'durationInDays',
		'enquiryPeriod_startDate',
		'enquiryPeriod_endDate',
		'qualificationPeriod_startDate',
		'qualificationPeriod_endDate',
		'eligibilityCriteria',
	),
)); ?>
