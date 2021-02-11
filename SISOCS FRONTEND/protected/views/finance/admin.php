<?php
/* @var $this FinanceController */
/* @var $model Finance */

$this->breadcrumbs=array(
	'Finances'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Finance', 'url'=>array('index')),
	array('label'=>'Crear Finance', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#finance-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Finances</h1>

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
	'id'=>'finance-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idContratacion',
		'title',
		'description',
		'financingParty_id',
		'financingParty_name',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
