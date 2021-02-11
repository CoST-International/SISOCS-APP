<?php
/* @var $this RelatedProcessController */
/* @var $model RelatedProcess */

$this->breadcrumbs=array(
	'Related Processes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RelatedProcess', 'url'=>array('index')),
	array('label'=>'Manage RelatedProcess', 'url'=>array('admin')),
);
?>

<h1>Create RelatedProcess</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>