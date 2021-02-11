<?php
/* @var $this PlanningMilestoneController */
/* @var $model PlanningMilestone */

$this->breadcrumbs=array(
	'Planning Milestones'=>array('index'),
	'Gestionar',
);

$this->menu=array(
	array('label'=>'Listar PlanningMilestone', 'url'=>array('index')),
	array('label'=>'Crear PlanningMilestone', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#planning-milestone-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gestionar Planning Milestones</h1>

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
	'id'=>'planning-milestone-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProyecto',
		'title',
		'description',
		'dueDate',
		'dateMet',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
