<?php
/* @var $this GarantiasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Garantiases',
);

$this->menu=array(
	array('label'=>'Crear Garantias', 'url'=>array('create')),
	array('label'=>'Gestionar Garantias', 'url'=>array('admin')),
);
?>

<h1>Garantiases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
