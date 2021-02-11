<?php
/* @var $this KpiObservationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kpi Observations',
);

$this->menu=array(
	array('label'=>'Crear KpiObservations', 'url'=>array('create')),
	array('label'=>'Gestionar KpiObservations', 'url'=>array('admin')),
);
?>

<h1>Kpi Observations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
