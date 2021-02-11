<?php
/* @var $this DebtEquityRatioController */
/* @var $model DebtEquityRatio */

$this->breadcrumbs=array(
	'Debt Equity Ratios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar DebtEquityRatio', 'url'=>array('index')),
	array('label'=>'Crear DebtEquityRatio', 'url'=>array('create')),
	array('label'=>'Actualizar DebtEquityRatio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar DebtEquityRatio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar DebtEquityRatio', 'url'=>array('admin')),
);
?>

<h1>View DebtEquityRatio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'shareCapitalDetails',
		'debtEquityRatio',
		'shareCapital_amount',
		'shareCapital_currency',
		'debtEquityRatioDetails',
		'subsidyRatio',
		'projectIRR',
		'subsidyRatioDetails',
	),
)); ?>
