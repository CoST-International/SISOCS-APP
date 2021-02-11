<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */

$this->breadcrumbs=array(
	'Forecast Observations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ForecastObservations', 'url'=>array('index')),
	array('label'=>'Crear ForecastObservations', 'url'=>array('create')),
	array('label'=>'Actualizar ForecastObservations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ForecastObservations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ForecastObservations', 'url'=>array('admin')),
);
?>

<h1>View ForecastObservations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'forecast_id',
		'obs_notes',
		'obs_amount',
		'obs_currency',
	),
)); ?>
