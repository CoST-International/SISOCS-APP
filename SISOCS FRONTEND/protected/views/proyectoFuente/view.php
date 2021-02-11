<?php
/* @var $this ProgramaFuenteController */
/* @var $model ProgramaFuente */

$this->breadcrumbs=array(
	'Programa Fuentes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ProgramaFuente', 'url'=>array('index')),
	array('label'=>'Crear ProgramaFuente', 'url'=>array('create')),
	array('label'=>'Actualizar ProgramaFuente', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Elimnar ProgramaFuente', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar ProgramaFuente', 'url'=>array('admin')),
);
?>

<h1>Ver Programa Fuente #<?php echo $model->programa; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'programa',
		'fuente',
		'monto',
		'moneda',
		'tasacambio',
		'fecha',
	),
)); ?>
