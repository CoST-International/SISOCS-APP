<?php
/* @var $this SubscriptionsController */
/* @var $model Subscriptions */

$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Subscriptions', 'url'=>array('index')),
	array('label'=>'Create Subscriptions', 'url'=>array('create')),
	array('label'=>'Update Subscriptions', 'url'=>array('update', 'id'=>$model->email)),
	array('label'=>'Delete Subscriptions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->email),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subscriptions', 'url'=>array('admin')),
);
?>

<h1>View Subscriptions #<?php echo $model->email; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'email',
	),
)); ?>
