<?php
/* @var $this BudgetBreakdownController */
/* @var $model BudgetBreakdown */

$this->breadcrumbs=array(
	'Budget Breakdowns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar BudgetBreakdown', 'url'=>array('index')),
	array('label'=>'Crear BudgetBreakdown', 'url'=>array('create')),
	array('label'=>'Actualizar BudgetBreakdown', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar BudgetBreakdown', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar BudgetBreakdown', 'url'=>array('admin')),
);
?>

<h1>View BudgetBreakdown #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProyecto',
		'description',
		'sourceParty_id',
		'sourceParty_name',
		'amount',
		'currency',
		'startDate',
		'endDate',
	),
)); ?>
