<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */

$this->breadcrumbs=array(
	'Forecast Observations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ForecastObservations', 'url'=>array('index')),
	array('label'=>'Crear ForecastObservations', 'url'=>array('create')),
	array('label'=>'View ForecastObservations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ForecastObservations', 'url'=>array('admin')),
);
?>

<h1>Actualizar ForecastObservations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>