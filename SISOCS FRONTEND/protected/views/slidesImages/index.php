<?php
/* @var $this SlidesImagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Slides Images',
);

$this->menu=array(
	array('label'=>'Create SlidesImages', 'url'=>array('create')),
	array('label'=>'Manage SlidesImages', 'url'=>array('admin')),
);
?>

<h1>Slides Images</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
