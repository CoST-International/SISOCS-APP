<?php
/* @var $this RiskCategoryController */
/* @var $model RiskCategory */

$this->breadcrumbs=array(
	'Risk Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RiskCategory', 'url'=>array('index')),
	array('label'=>'Manage RiskCategory', 'url'=>array('admin')),
);
?>

<h1>Create RiskCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>