<?php
/* @var $this TipoGarantiasController */
/* @var $model TipoGarantias */

$this->breadcrumbs=array(
	'Tipo Garantiases'=>array('index'),
	$model->idTipoGarantia,
);

$this->menu=array(
	array('label'=>'Listar TipoGarantias', 'url'=>array('index')),
	array('label'=>'Crear TipoGarantias', 'url'=>array('create')),
	array('label'=>'Actualizar TipoGarantias', 'url'=>array('update', 'id'=>$model->idTipoGarantia)),
	array('label'=>'Eliminar TipoGarantias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idTipoGarantia),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar TipoGarantias', 'url'=>array('admin')),
);
?>

<h1>View TipoGarantias #<?php echo $model->idTipoGarantia; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idTipoGarantia',
		'nombre',
	),
)); ?>
