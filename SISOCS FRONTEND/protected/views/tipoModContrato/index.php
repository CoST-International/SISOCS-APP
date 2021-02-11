<?php
/* @var $this TipoModContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Mod Contratos',
);

$this->menu=array(
	array('label'=>'Crear TipoModContrato', 'url'=>array('create')),
	array('label'=>'Gestionar TipoModContrato', 'url'=>array('admin')),
);
?>

<h1>Tipo Mod Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
