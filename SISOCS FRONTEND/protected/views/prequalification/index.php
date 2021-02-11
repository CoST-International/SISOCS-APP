<?php
/* @var $this PrequalificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Prequalifications',
);

$this->menu=array(
	array('label'=>'Crear Prequalification', 'url'=>array('create')),
	array('label'=>'Gestionar Prequalification', 'url'=>array('admin')),
);
?>

<h1>Prequalifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
