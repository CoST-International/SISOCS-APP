<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	$model->idCurrency,
);

$this->menu=array(
	array('label'=>'Listar Currency', 'url'=>array('index')),
	array('label'=>'Crear Currency', 'url'=>array('create')),
	array('label'=>'Actualizar Currency', 'url'=>array('update', 'id'=>$model->idCurrency)),
	array('label'=>'Eliminar Currency', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idCurrency),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Currency', 'url'=>array('admin')),
);
?>

<h1>View Currency #<?php echo $model->idCurrency; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idCurrency',
		'moneda',
	),
)); ?>
