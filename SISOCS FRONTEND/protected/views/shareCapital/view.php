<?php
/* @var $this ShareCapitalController */
/* @var $model ShareCapital */

$this->breadcrumbs=array(
	'Share Capitals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ShareCapital', 'url'=>array('index')),
	array('label'=>'Crear ShareCapital', 'url'=>array('create')),
	array('label'=>'Actualizar ShareCapital', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ShareCapital', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ShareCapital', 'url'=>array('admin')),
);
?>

<h1>View ShareCapital #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'debtEquityRatio',
		'shareCapital_amount',
		'shareCapital_currency',
		'projectIRR',
	),
)); ?>
