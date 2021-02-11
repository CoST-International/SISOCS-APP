<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */

$this->breadcrumbs=array(
	'Forecast Observations'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ForecastObservations', 'url'=>array('index')),
	array('label'=>'Gestionar ForecastObservations', 'url'=>array('admin')),
);
?>

<h1>Crear ForecastObservations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>