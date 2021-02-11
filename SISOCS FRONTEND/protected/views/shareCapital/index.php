<?php
/* @var $this ShareCapitalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Share Capitals',
);

$this->menu=array(
	array('label'=>'Crear ShareCapital', 'url'=>array('create')),
	array('label'=>'Gestionar ShareCapital', 'url'=>array('admin')),
);
?>

<h1>Share Capitals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
