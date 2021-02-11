<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->codigo,
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Actualizar Avances', 'url'=>array('update', 'id'=>$model->codigo)),
	array('label'=>'Eliminar Avances', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->codigo),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Administrar Avances', 'url'=>array('admin')),
);
?>

<h1>Ver avances en la ejecuci&oacute;n #<?php echo $model->codigo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'codigo',
		'codigo_inicio_ejecucion',
		'porcent_programado',
		'porcent_real',
		'finan_programado',
		'finan_real',
		//'fecha_registro',
		//'user_registro',
		'fecha_avance',
		'desc_problemas',
		'desc_temas',
	),
)); ?>
