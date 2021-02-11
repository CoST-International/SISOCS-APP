<?php
/* @var $this ShareCapitalController */
/* @var $model ShareCapital */

$this->breadcrumbs=array(
	'Share Capitals'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar ShareCapital', 'url'=>array('index')),
	array('label'=>'Crear ShareCapital', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#share-capital-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Share Capitals</h1>

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
	'id'=>'share-capital-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idContratacion',
		'debtEquityRatio',
		'shareCapital_amount',
		'shareCapital_currency',
		'projectIRR',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
