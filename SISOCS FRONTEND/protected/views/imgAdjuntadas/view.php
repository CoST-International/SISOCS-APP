<?php
/* @var $this ImgAdjuntadasController */
/* @var $model ImgAdjuntadas */

$this->breadcrumbs=array(
	'Img Adjuntadases'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'Listar ImgAdjuntadas', 'url'=>array('index')),
	array('label'=>'Crear ImgAdjuntadas', 'url'=>array('create')),
	array('label'=>'Actualizar ImgAdjuntadas', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Eliminar ImgAdjuntadas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ImgAdjuntadas', 'url'=>array('admin')),
);
?>

<h1>View ImgAdjuntadas #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'cod_contrato',
		'nombre_img',
		'ubicacion_img',
		'fecha_registro',
		'user_registro',
	),
)); ?>
