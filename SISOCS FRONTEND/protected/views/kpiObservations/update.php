<?php
/* @var $this KpiObservationsController */
/* @var $model KpiObservations */

$this->breadcrumbs=array(
	'Kpi Observations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar KpiObservations', 'url'=>array('index')),
	array('label'=>'Crear KpiObservations', 'url'=>array('create')),
	array('label'=>'View KpiObservations', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar KpiObservations', 'url'=>array('admin')),
);
?>

<h1>Actualizar KpiObservations <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>