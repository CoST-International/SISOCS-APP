<?php
/* @var $this BudgetBreakdownController */
/* @var $model BudgetBreakdown */

$this->breadcrumbs=array(
	'Budget Breakdowns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar BudgetBreakdown', 'url'=>array('index')),
	array('label'=>'Crear BudgetBreakdown', 'url'=>array('create')),
	array('label'=>'View BudgetBreakdown', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar BudgetBreakdown', 'url'=>array('admin')),
);
?>

<h1>Actualizar BudgetBreakdown <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>