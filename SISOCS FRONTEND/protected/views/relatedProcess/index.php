<?php
/* @var $this RelatedProcessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Related Processes',
);

$this->menu=array(
	array('label'=>'Create RelatedProcess', 'url'=>array('create')),
	array('label'=>'Manage RelatedProcess', 'url'=>array('admin')),
);
?>

<h1>Related Processes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
