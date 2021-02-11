<?php
/* @var $this RelatedProcessController */
/* @var $model RelatedProcess */

$this->breadcrumbs=array(
	'Related Processes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RelatedProcess', 'url'=>array('index')),
	array('label'=>'Create RelatedProcess', 'url'=>array('create')),
	array('label'=>'Update RelatedProcess', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RelatedProcess', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RelatedProcess', 'url'=>array('admin')),
);
?>

<h1>View RelatedProcess #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'idProyecto',
	),
)); ?>
