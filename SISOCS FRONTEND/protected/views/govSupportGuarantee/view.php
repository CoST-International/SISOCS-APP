<?php
/* @var $this GovSupportGuaranteeController */
/* @var $model GovSupportGuarantee */

$this->breadcrumbs=array(
	'Gov Support Guarantees'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar GovSupportGuarantee', 'url'=>array('index')),
	array('label'=>'Crear GovSupportGuarantee', 'url'=>array('create')),
	array('label'=>'Actualizar GovSupportGuarantee', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar GovSupportGuarantee', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar GovSupportGuarantee', 'url'=>array('admin')),
);
?>

<h1>View GovSupportGuarantee #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'financeCategory',
		'title',
		'startDate',
		'endDate',
		'durationInDays',
		'amount',
		'currency',
	),
)); ?>
