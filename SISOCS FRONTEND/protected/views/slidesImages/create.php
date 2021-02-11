<?php
/* @var $this SlidesImagesController */
/* @var $model SlidesImages */

$this->breadcrumbs=array(
	'Slides Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SlidesImages', 'url'=>array('index')),
	array('label'=>'Manage SlidesImages', 'url'=>array('admin')),
);
?>

<h1>Create SlidesImages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>