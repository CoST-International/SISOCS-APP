<?php
/* @var $this PlanningDocumentsController */
/* @var $model PlanningDocuments */

$this->breadcrumbs=array(
	'Planning Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar PlanningDocuments', 'url'=>array('index')),
	array('label'=>'Crear PlanningDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar PlanningDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar PlanningDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar PlanningDocuments', 'url'=>array('admin')),
);
?>

<h1>View PlanningDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProyecto',
		'documentType',
		'title',
		'description',
		'url',
		'pageStart',
		'pageEnd',
		'datePublished',
		'dateModified',
		'accessDetails',
	),
)); ?>
