<?php
/* @var $this ContratosDocumentsController */
/* @var $model ContratosDocuments */

$this->breadcrumbs=array(
	'Contratos Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ContratosDocuments', 'url'=>array('index')),
	array('label'=>'Crear ContratosDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar ContratosDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ContratosDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ContratosDocuments', 'url'=>array('admin')),
);
?>

<h1>View ContratosDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContrato',
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
