<?php
/* @var $this MetodoController */
/* @var $model Metodo */

$this->breadcrumbs=array(
	'Metodos'=>array('index'),
	$model->idmetodo,
);

$this->menu=array(
	array('label'=>'Listar Metodo', 'url'=>array('index')),
	array('label'=>'Crear Metodo', 'url'=>array('create')),
	array('label'=>'Actualizar Metodo', 'url'=>array('update', 'id'=>$model->idmetodo)),
	array('label'=>'Eliminar Metodo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idmetodo),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Metodo', 'url'=>array('admin')),
);
?>

<h1>View Metodo #<?php echo $model->idmetodo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idmetodo',
		'adquisicion',
		'siglas',
	),
)); ?>
