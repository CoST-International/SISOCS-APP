<?php
/* @var $this KpiObservationsController */
/* @var $model KpiObservations */

$this->breadcrumbs=array(
	'Kpi Observations'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar KpiObservations', 'url'=>array('index')),
	array('label'=>'Gestionar KpiObservations', 'url'=>array('admin')),
);
?>

<h1>Crear KpiObservations</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>