<?php
/* @var $this FuentesfinanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fuentesfinans',
);

$this->menu=array(
	array('label'=>'Crear Fuentes de Financiamiento', 'url'=>array('create')),
	array('label'=>'Administrar Fuentes de Financiamiento', 'url'=>array('admin')),
);
?>

<h1> Fuentes de Financiamiento</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
