<?php
/* @var $this ForecastController */
/* @var $model Forecast */

$this->breadcrumbs=array(
	'Forecasts'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Forecast', 'url'=>array('index')),
	array('label'=>'Crear Forecast', 'url'=>array('create')),
	array('label'=>'View Forecast', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Forecast', 'url'=>array('admin')),
);
?>

<h1>Actualizar Forecast <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>