<?php
/* @var $this RiskCategoryController */
/* @var $model RiskCategory */

$this->breadcrumbs=array(
	'Risk Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RiskCategory', 'url'=>array('index')),
	array('label'=>'Create RiskCategory', 'url'=>array('create')),
	array('label'=>'View RiskCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RiskCategory', 'url'=>array('admin')),
);
?>

<h1>Update RiskCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>