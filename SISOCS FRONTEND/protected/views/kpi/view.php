<?php
/* @var $this KpiController */
/* @var $model Kpi */

$this->breadcrumbs=array(
	'Kpis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Kpi', 'url'=>array('index')),
	array('label'=>'Crear Kpi', 'url'=>array('create')),
	array('label'=>'Actualizar Kpi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Kpi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar Kpi', 'url'=>array('admin')),
);
?>

<h1>View Kpi #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idInicioEjecucion',
		'tittle',
		'description',
	),
)); ?>
