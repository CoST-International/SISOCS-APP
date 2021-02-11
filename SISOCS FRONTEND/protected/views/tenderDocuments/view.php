<?php
/* @var $this TenderDocumentsController */
/* @var $model TenderDocuments */

$this->breadcrumbs=array(
	'Tender Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar TenderDocuments', 'url'=>array('index')),
	array('label'=>'Crear TenderDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar TenderDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar TenderDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar TenderDocuments', 'url'=>array('admin')),
);
?>

<h1>View TenderDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idCalificacion',
		'documentType',
		'title',
		'description',
		'pageStart',
		'pageEnd',
		'url',
		'datePublished',
		'dateModified',
		'accessDetails',
	),
)); ?>
