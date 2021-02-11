<?php
/* @var $this EntesController */
/* @var $model Entes */

$this->breadcrumbs=array(
	//'Entes'=>array('index'),
	$model->idEnte,
);

$this->menu=array(
	//array('label'=>'Listar Entes', 'url'=>array('index')),
	array('label'=>'Crear Entes', 'url'=>array('create')),
	array('label'=>'Actualizar Entes', 'url'=>array('update', 'id'=>$model->idEnte)),
	//array('label'=>'Eliminar Entes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEnte),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Entes', 'url'=>array('admin')),
);
?>

<h1>Ver Ente #<?php echo $model->idEnte; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idEnte',
		'descripcion',
	),
)); ?>
