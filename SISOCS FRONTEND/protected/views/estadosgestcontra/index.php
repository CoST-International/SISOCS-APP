<?php
/* @var $this EstadosgestcontraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Estadosgestcontras',
);

$this->menu=array(
	array('label'=>'Crear Estados Gestión Contratos', 'url'=>array('create')),
	array('label'=>'Gestionar Estados Gestión Contratos', 'url'=>array('admin')),
);
?>

<h1>Estadosgestcontras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
