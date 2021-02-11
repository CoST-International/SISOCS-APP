<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */

$this->breadcrumbs=array(
	'Prequalifications'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar Prequalification', 'url'=>array('index')),
	array('label'=>'Crear Prequalification', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#prequalification-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Prequalifications</h1>

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
	'id'=>'prequalification-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProyecto',
		'startDate',
		'endDate',
		'durationInDays',
		'enquiryPeriod_startDate',
		/*
		'enquiryPeriod_endDate',
		'qualificationPeriod_startDate',
		'qualificationPeriod_endDate',
		'eligibilityCriteria',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
