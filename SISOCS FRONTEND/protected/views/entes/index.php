<?php
/* @var $this EntesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entes',
);

$this->menu=array(
	array('label'=>'Crear Entes', 'url'=>array('create')),
	array('label'=>'Gestionar Entes', 'url'=>array('admin')),
);
?>

<h1>Entes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
