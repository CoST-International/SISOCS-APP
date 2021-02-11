<?php
/* @var $this TipoModContratoController */
/* @var $model TipoModContrato */

$this->breadcrumbs=array(
	//'Tipo Mod Contratos'=>array('index'),
	$model->idTipoModificacion,
);

$this->menu=array(
	//array('label'=>'Listar TipoModContrato', 'url'=>array('index')),
	array('label'=>'Crear TipoModContrato', 'url'=>array('create')),
	array('label'=>'Actualizar TipoModContrato', 'url'=>array('update', 'id'=>$model->idTipoModificacion)),
	//array('label'=>'Eliminar TipoModContrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idTipoModificacion),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar TipoModContrato', 'url'=>array('admin')),
);
?>

<h1>Ver TipoModContrato #<?php echo $model->idTipoModificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idTipoModificacion',
		'tipo_modificacion',
	),
)); ?>
