<?php
/* @var $this KpiObservationsController */
/* @var $model KpiObservations */

$this->breadcrumbs=array(
	'Kpi Observations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar KpiObservations', 'url'=>array('index')),
	array('label'=>'Crear KpiObservations', 'url'=>array('create')),
	array('label'=>'Actualizar KpiObservations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar KpiObservations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar KpiObservations', 'url'=>array('admin')),
);
?>

<h1>View KpiObservations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kpi_id',
		'tittle',
		'description',
		'amount',
		'currency',
		'measure',
		'relatedImplementationMilestone_id',
		'relatedImplementationMilestone_title',
		'startDate',
		'endDate',
	),
)); ?>
