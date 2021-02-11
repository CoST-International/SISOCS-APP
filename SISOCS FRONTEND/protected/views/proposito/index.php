<?php
/* @var $this PropositoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Propositos',
);

$this->menu=array(
	array('label'=>'Crear Proposito', 'url'=>array('create')),
	array('label'=>'Gestionar Proposito', 'url'=>array('admin')),
);
?>

<h1>Propositos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
