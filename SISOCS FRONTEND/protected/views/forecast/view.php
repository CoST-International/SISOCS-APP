<?php
/* @var $this ForecastController */
/* @var $model Forecast */

$this->breadcrumbs=array(
	'Forecasts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar Forecast', 'url'=>array('index')),
	array('label'=>'Crear Forecast', 'url'=>array('create')),
	array('label'=>'Actualizar Forecast', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Forecast', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Forecast', 'url'=>array('admin')),
);
?>

<h1>View Forecast #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProyecto',
		'title',
	),
)); ?>
