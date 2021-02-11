<?php
/* @var $this AmendmentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Amendments',
);

$this->menu=array(
	array('label'=>'Crear Amendment', 'url'=>array('create')),
	array('label'=>'Gestionar Amendment', 'url'=>array('admin')),
);
?>

<h1>Amendments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
