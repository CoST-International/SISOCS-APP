<?php
/* @var $this ImplementationDocumentsController */
/* @var $model ImplementationDocuments */

$this->breadcrumbs=array(
	'Implementation Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ImplementationDocuments', 'url'=>array('index')),
	array('label'=>'Crear ImplementationDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar ImplementationDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ImplementationDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ImplementationDocuments', 'url'=>array('admin')),
);
?>

<h1>View ImplementationDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idInicioEjecucion',
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
