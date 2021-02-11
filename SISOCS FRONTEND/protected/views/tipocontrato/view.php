<?php
/* @var $this TipocontratoController */
/* @var $model Tipocontrato */

$this->breadcrumbs=array(
	//'Tipocontratos'=>array('index'),
	$model->idTipoContrato,
);

$this->menu=array(
	//array('label'=>'Listar Tipocontrato', 'url'=>array('index')),
	array('label'=>'Crear Tipocontrato', 'url'=>array('create')),
	//array('label'=>'Actualizar Tipocontrato', 'url'=>array('update', 'id'=>$model->idTipoContrato)),
	//array('label'=>'Eliminar Tipocontrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idTipoContrato),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Tipocontrato', 'url'=>array('admin')),
);
?>

<h1>Ver Tipocontrato #<?php echo $model->idTipoContrato; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idTipoContrato',
		'contrato',
	),
)); ?>
