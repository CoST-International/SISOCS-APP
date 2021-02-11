<?php
/* @var $this PartiesController */
/* @var $model Parties */

$this->breadcrumbs=array(
	'Parties'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Parties', 'url'=>array('index')),
	array('label'=>'Crear Parties', 'url'=>array('create')),
	array('label'=>'Actualizar Parties', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Parties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Parties', 'url'=>array('admin')),
);
?>

<h1>View Parties #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'legalName',
		'uri',
		'streetAddress',
		'locality',
		'region',
		'countryName',
		'contactPoint_name',
		'contactPoint_email',
		'contactPoint_telephone',
		'roles',
	),
)); ?>
