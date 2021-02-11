<?php
/* @var $this ForecastObservationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Forecast Observations',
);

$this->menu=array(
	array('label'=>'Crear ForecastObservations', 'url'=>array('create')),
	array('label'=>'Gestionar ForecastObservations', 'url'=>array('admin')),
);
?>

<h1>Forecast Observations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
