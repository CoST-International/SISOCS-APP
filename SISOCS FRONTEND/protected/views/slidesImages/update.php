<?php
/* @var $this SlidesImagesController */
/* @var $model SlidesImages */

$this->breadcrumbs=array(
	'Slides Images'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SlidesImages', 'url'=>array('index')),
	array('label'=>'Create SlidesImages', 'url'=>array('create')),
	array('label'=>'View SlidesImages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SlidesImages', 'url'=>array('admin')),
);
?>

<h1>Update SlidesImages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>