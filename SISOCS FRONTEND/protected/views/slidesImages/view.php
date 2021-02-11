<?php
/* @var $this SlidesImagesController */
/* @var $model SlidesImages */

$this->breadcrumbs=array(
	'Slides Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SlidesImages', 'url'=>array('index')),
	array('label'=>'Create SlidesImages', 'url'=>array('create')),
	array('label'=>'Update SlidesImages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SlidesImages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SlidesImages', 'url'=>array('admin')),
);
?>

<h1>View SlidesImages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'url',
		'title',
		'description',
	),
)); ?>
