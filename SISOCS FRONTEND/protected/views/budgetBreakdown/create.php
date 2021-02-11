<?php
/* @var $this BudgetBreakdownController */
/* @var $model BudgetBreakdown */

$this->breadcrumbs=array(
	'Budget Breakdowns'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar BudgetBreakdown', 'url'=>array('index')),
	array('label'=>'Gestionar BudgetBreakdown', 'url'=>array('admin')),
);
?>

<h1>Crear BudgetBreakdown</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>