<?php
/* @var $this EntesUnidadController */
/* @var $model EntesUnidad */

$this->breadcrumbs=array(
	//'Entes Unidads'=>array('index'),
	$model->idUnidad,
);

$this->menu=array(
	//array('label'=>'Listar EntesUnidad', 'url'=>array('index')),
	array('label'=>'Crear EntesUnidad', 'url'=>array('create')),
	//array('label'=>'Actualizar EntesUnidad', 'url'=>array('update', 'id'=>$model->idUnidad)),
	//array('label'=>'Eliminar EntesUnidad', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idUnidad),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar EntesUnidad', 'url'=>array('admin')),
);
?>

<h1>View EntesUnidad #<?php //echo $model->idUnidad; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idUnidad',
		'nombre',
		'idEnte',
	),
)); ?>
