<?php
/* @var $this ForecastController */
/* @var $model Forecast */

$this->breadcrumbs=array(
	'Forecasts'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Forecast', 'url'=>array('index')),
	array('label'=>'Gestionar Forecast', 'url'=>array('admin')),
);
?>

<h1>Crear Forecast</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>