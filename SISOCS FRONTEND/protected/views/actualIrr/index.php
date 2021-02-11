<?php
/* @var $this ActualIrrController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actual Irrs',
);

$this->menu=array(
	array('label'=>'Crear ActualIrr', 'url'=>array('create')),
	array('label'=>'Gestionar ActualIrr', 'url'=>array('admin')),
);
?>

<h1>Actual Irrs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
