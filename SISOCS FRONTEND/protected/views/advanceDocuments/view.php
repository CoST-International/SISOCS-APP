<?php
/* @var $this AdvanceDocumentsController */
/* @var $model AdvanceDocuments */

$this->breadcrumbs=array(
	'Advance Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar AdvanceDocuments', 'url'=>array('index')),
	array('label'=>'Crear AdvanceDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar AdvanceDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar AdvanceDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar AdvanceDocuments', 'url'=>array('admin')),
);
?>

<h1>View AdvanceDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idAvance',
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
