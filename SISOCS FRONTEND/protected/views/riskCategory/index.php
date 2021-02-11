<?php
/* @var $this RiskCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Risk Categories',
);

$this->menu=array(
	array('label'=>'Create RiskCategory', 'url'=>array('create')),
	array('label'=>'Manage RiskCategory', 'url'=>array('admin')),
);
?>

<h1>Risk Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
