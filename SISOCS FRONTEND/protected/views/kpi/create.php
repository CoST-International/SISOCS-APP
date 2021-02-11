<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Kpi', 'url'=>array('index')),
	array('label'=>'Gestionar Kpi', 'url'=>array('admin')),
);
?>

<h1>Crear Kpi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>