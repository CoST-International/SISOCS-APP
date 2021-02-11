<?php
/* @var $this RiskCategoryController */
/* @var $model RiskCategory */

$this->breadcrumbs=array(
	'Risk Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RiskCategory', 'url'=>array('index')),
	array('label'=>'Create RiskCategory', 'url'=>array('create')),
	array('label'=>'Update RiskCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RiskCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RiskCategory', 'url'=>array('admin')),
);
?>

<h1>View RiskCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descripcion',
	),
)); ?>
