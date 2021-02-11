<?php
/* @var $this ForecastObservationsController */
/* @var $model ForecastObservations */

$this->breadcrumbs=array(
	'Forecast Observations'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar ForecastObservations', 'url'=>array('index')),
	array('label'=>'Crear ForecastObservations', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#forecast-observations-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Forecast Observations</h1>

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
	'id'=>'forecast-observations-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'forecast_id',
		'obs_notes',
		'obs_amount',
		'obs_currency',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
