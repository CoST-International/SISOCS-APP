<?php
/* @var $this ShareholdersController */
/* @var $model Shareholders */

$this->breadcrumbs=array(
	'Shareholders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Shareholders', 'url'=>array('index')),
	array('label'=>'Crear Shareholders', 'url'=>array('create')),
	array('label'=>'Actualizar Shareholders', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Shareholders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Shareholders', 'url'=>array('admin')),
);
?>

<h1>View Shareholders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'shareholder_id',
		'shareholder_name',
		'votingRights',
		'votingRightsDetails',
		'shareholding',
	),
)); ?>
