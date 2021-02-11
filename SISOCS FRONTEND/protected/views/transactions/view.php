<?php
/* @var $this TransactionsController */
/* @var $model Transactions */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Transactions', 'url'=>array('index')),
	array('label'=>'Crear Transactions', 'url'=>array('create')),
	array('label'=>'Actualizar Transactions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Transactions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Transactions', 'url'=>array('admin')),
);
?>

<h1>View Transactions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idInicioEjecucion',
		'date',
		'source',
		'payer_id',
		'payer_name',
		'payee_id',
		'payee_name',
		'amount',
		'currency',
		'relatedImplementationMilestone',
	),
)); ?>
