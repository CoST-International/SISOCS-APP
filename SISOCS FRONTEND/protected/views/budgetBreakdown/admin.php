<?php
/* @var $this BudgetBreakdownController */
/* @var $model BudgetBreakdown */

$this->breadcrumbs=array(
	'Budget Breakdowns'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar BudgetBreakdown', 'url'=>array('index')),
	array('label'=>'Crear BudgetBreakdown', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#budget-breakdown-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Budget Breakdowns</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'budget-breakdown-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProyecto',
		'description',
		'sourceParty_id',
		'sourceParty_name',
		'amount',
		/*
		'currency',
		'startDate',
		'endDate',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
