<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar Finance', 'url'=>array('index')),
	array('label'=>'Crear Finance', 'url'=>array('create')),
	array('label'=>'Actualizar Finance', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Finance', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Finance', 'url'=>array('admin')),
);
?>

<h1>View Finance #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'title',
		'description',
		'financingParty_id',
		'financingParty_name',
		'financeCategory',
		'amount',
		'currency',
		'startDate',
		'endDate',
		'interestRate_base',
		'interestRate_margin',
		'interestRate_fixed',
		'stepInRights',
		'exchangeRateGuarantee',
		'repaymentFrequency',
	),
)); ?>
