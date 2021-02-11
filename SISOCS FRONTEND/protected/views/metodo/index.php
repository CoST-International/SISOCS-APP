<?php
/* @var $this MetodoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Metodos',
);

$this->menu=array(
	array('label'=>'Crear Metodo', 'url'=>array('create')),
	array('label'=>'Gestionar Metodo', 'url'=>array('admin')),
);
?>

<h1>Metodos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
