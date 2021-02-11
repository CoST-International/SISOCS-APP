<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Kpi', 'url'=>array('index')),
	array('label'=>'Crear Kpi', 'url'=>array('create')),
	array('label'=>'View Kpi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Kpi', 'url'=>array('admin')),
);
?>

<h1>Actualizar Kpi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>