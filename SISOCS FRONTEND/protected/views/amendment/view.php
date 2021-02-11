<?php
/* @var $this AmendmentController */
/* @var $model Amendment */

$this->breadcrumbs=array(
	'Amendments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Amendment', 'url'=>array('index')),
	array('label'=>'Crear Amendment', 'url'=>array('create')),
	array('label'=>'Actualizar Amendment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Amendment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Amendment', 'url'=>array('admin')),
);
?>

<h1>View Amendment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'date',
		'rationale',
		'description',
		'amendsReleaseID',
		'releaseID',
	),
)); ?>
