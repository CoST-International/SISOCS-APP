<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	$model->idLocality,
);

$this->menu=array(
	array('label'=>'Listar Locality', 'url'=>array('index')),
	array('label'=>'Crear Locality', 'url'=>array('create')),
	array('label'=>'Actualizar Locality', 'url'=>array('update', 'id'=>$model->idLocality)),
	array('label'=>'Eliminar Locality', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idLocality),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Locality', 'url'=>array('admin')),
);
?>

<h1>View Locality #<?php echo $model->idLocality; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idLocality',
		'descripcion',
	),
)); ?>
