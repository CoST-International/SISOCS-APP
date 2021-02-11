<?php
/* @var $this EstadosgestcontraController */
/* @var $model Estadosgestcontra */

$this->breadcrumbs=array(
	//'Estadosgestcontras'=>array('index'),
	$model->idEstadoGesion,
);

$this->menu=array(
	//array('label'=>'Listar Estados Gestión Contratos', 'url'=>array('index')),
	array('label'=>'Crear Estados Gestión Contratos', 'url'=>array('create')),
	//array('label'=>'Actualizar Estados Gestión Contratos', 'url'=>array('update', 'id'=>$model->idEstadoGesion)),
	//array('label'=>'Eliminar Estados Gestión Contratos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idEstadoGesion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Estados Gestión Contratos', 'url'=>array('admin')),
);
?>

<h1>Ver Estadosgestcontra #<?php echo $model->idEstadoGesion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idEstadoGesion',
		'estado',
		'descripcion',
	),
)); ?>
