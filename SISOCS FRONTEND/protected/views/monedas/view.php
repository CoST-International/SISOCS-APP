<?php
/* @var $this MonedasController */
/* @var $model Monedas */

$this->breadcrumbs=array(
	'Monedases'=>array('index'),
	$model->idMoneda,
);

$this->menu=array(
	array('label'=>'Listar Monedas', 'url'=>array('index')),
	array('label'=>'Crear Monedas', 'url'=>array('create')),
	array('label'=>'Actualizar Monedas', 'url'=>array('update', 'id'=>$model->idMoneda)),
	array('label'=>'Borrar Monedas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idMoneda),'confirm'=>'¿Est&aacute seguro/a de borrar este item?')),
	array('label'=>'Administrar Monedas', 'url'=>array('admin')),
);
?>

<h1>Ver Monedas #<?php echo $model->idMoneda; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idMoneda',
		'moneda',
	),
)); ?>
