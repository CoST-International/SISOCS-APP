<?php
/* @var $this BudgetBreakdownController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Budget Breakdowns',
);

$this->menu=array(
	array('label'=>'Crear BudgetBreakdown', 'url'=>array('create')),
	array('label'=>'Gestionar BudgetBreakdown', 'url'=>array('admin')),
);
?>

<h1>Budget Breakdowns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
