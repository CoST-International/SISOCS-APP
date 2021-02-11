<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->idRegion,
);

$this->menu=array(
	array('label'=>'Listar Region', 'url'=>array('index')),
	array('label'=>'Crear Region', 'url'=>array('create')),
	array('label'=>'Actualizar Region', 'url'=>array('update', 'id'=>$model->idRegion)),
	array('label'=>'Eliminar Region', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idRegion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Region', 'url'=>array('admin')),
);
?>

<h1>View Region #<?php echo $model->idRegion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idRegion',
		'descripcion',
	),
)); ?>
