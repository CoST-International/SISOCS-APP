<?php
/* @var $this RelatedProcessController */
/* @var $model RelatedProcess */

$this->breadcrumbs=array(
	'Related Processes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RelatedProcess', 'url'=>array('index')),
	array('label'=>'Create RelatedProcess', 'url'=>array('create')),
	array('label'=>'View RelatedProcess', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RelatedProcess', 'url'=>array('admin')),
);
?>

<h1>Update RelatedProcess <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>