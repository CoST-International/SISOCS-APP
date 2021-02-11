<?php
/* @var $this MonedasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Monedases',
);

$this->menu=array(
	array('label'=>'Crear Monedas', 'url'=>array('create')),
	array('label'=>'Administrar Monedas', 'url'=>array('admin')),
);
?>

<h1>Monedas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
