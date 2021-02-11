<?php
/* @var $this TipoGarantiasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Garantiases',
);

$this->menu=array(
	array('label'=>'Crear TipoGarantias', 'url'=>array('create')),
	array('label'=>'Gestionar TipoGarantias', 'url'=>array('admin')),
);
?>

<h1>Tipo Garantiases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
