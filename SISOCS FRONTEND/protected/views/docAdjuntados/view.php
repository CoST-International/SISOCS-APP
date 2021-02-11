<?php
/* @var $this DocAdjuntadosController */
/* @var $model DocAdjuntados */

$this->breadcrumbs=array(
	'Doc Adjuntadoses'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'Listar DocAdjuntados', 'url'=>array('index')),
	array('label'=>'Crear DocAdjuntados', 'url'=>array('create')),
	array('label'=>'Actualizar DocAdjuntados', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Eliminar DocAdjuntados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar DocAdjuntados', 'url'=>array('admin')),
);
?>

<h1>View DocAdjuntados #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'cod_contrato',
		'nombre_doc',
		'ubicacion_doc',
		'fecha_registro',
		'user_registro',
	),
)); ?>
