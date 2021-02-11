<?php
/* @var $this DocumentTypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Document Types',
);

$this->menu=array(
	array('label'=>'Crear DocumentTypes', 'url'=>array('create')),
	array('label'=>'Gestionar DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>Document Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
