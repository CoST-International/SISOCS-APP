<?php
/* @var $this PartyRolController */
/* @var $model PartyRol */

$this->breadcrumbs=array(
	'Party Rols'=>array('index'),
	$model->idRol,
);

$this->menu=array(
	array('label'=>'Listar PartyRol', 'url'=>array('index')),
	array('label'=>'Crear PartyRol', 'url'=>array('create')),
	array('label'=>'Actualizar PartyRol', 'url'=>array('update', 'id'=>$model->idRol)),
	array('label'=>'Eliminar PartyRol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idRol),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar PartyRol', 'url'=>array('admin')),
);
?>

<h1>View PartyRol #<?php echo $model->idRol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idRol',
		'descripcion',
	),
)); ?>
