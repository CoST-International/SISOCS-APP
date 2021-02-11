<?php
/* @var $this FinalizacionDocumentsController */
/* @var $model FinalizacionDocuments */

$this->breadcrumbs=array(
	'Finalizacion Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar FinalizacionDocuments', 'url'=>array('index')),
	array('label'=>'Crear FinalizacionDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar FinalizacionDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar FinalizacionDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar FinalizacionDocuments', 'url'=>array('admin')),
);
?>

<h1>View FinalizacionDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idFinalizacion',
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
