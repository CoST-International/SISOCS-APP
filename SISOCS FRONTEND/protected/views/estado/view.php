<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	//'Estados'=>array('index'),
	$model->estado,
);

$this->menu=array(
	//array('label'=>'Listar Estado', 'url'=>array('index')),
	array('label'=>'Crear Estado', 'url'=>array('create')),
	array('label'=>'Actualizar Estado', 'url'=>array('update', 'id'=>$model->estado)),
	//array('label'=>'Borrar Estado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->estado),'confirm'=>'�Est&aacute seguro/a de borrar este item?')),
	array('label'=>'Administrar Estado', 'url'=>array('admin')),
);
?>

<h1>Ver Estado #<?php echo $model->estado; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'estado',
	),
)); ?>
