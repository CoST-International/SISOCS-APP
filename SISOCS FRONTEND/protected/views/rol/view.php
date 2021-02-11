<?php
/* @var $this RolController */
/* @var $model Rol */

$this->breadcrumbs=array(
	//'Rols'=>array('index'),
	$model->idRol,
);

$this->menu=array(
	//array('label'=>'Listar Rol', 'url'=>array('index')),
	array('label'=>'Crear Rol', 'url'=>array('create')),
	array('label'=>'Actualizar Rol', 'url'=>array('update', 'id'=>$model->idRol)),
	//array('label'=>'Eliminar Rol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idRol),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Rol', 'url'=>array('admin')),
);
?>

<h1>Ver Rol #<?php echo $model->idRol; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idRol',
		'rol',
	),
)); ?>
