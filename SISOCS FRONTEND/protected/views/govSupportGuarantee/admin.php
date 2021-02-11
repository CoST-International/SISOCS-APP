<?php
/* @var $this GovSupportGuaranteeController */
/* @var $model GovSupportGuarantee */

$this->breadcrumbs=array(
	'Gov Support Guarantees'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar GovSupportGuarantee', 'url'=>array('index')),
	array('label'=>'Crear GovSupportGuarantee', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gov-support-guarantee-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Gov Support Guarantees</h1>

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
	'id'=>'gov-support-guarantee-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idContratacion',
		'financeCategory',
		'title',
		'startDate',
		'endDate',
		/*
		'durationInDays',
		'amount',
		'currency',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
