<?php
/* @var $this TipocontratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipocontratos',
);

$this->menu=array(
	array('label'=>'Crear Tipocontrato', 'url'=>array('create')),
	array('label'=>'Gestionar Tipocontrato', 'url'=>array('admin')),
);
?>

<h1>Tipocontratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
