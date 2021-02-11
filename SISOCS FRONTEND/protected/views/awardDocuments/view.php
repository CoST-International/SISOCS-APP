<?php
/* @var $this AwardDocumentsController */
/* @var $model AwardDocuments */

$this->breadcrumbs=array(
	'Award Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar AwardDocuments', 'url'=>array('index')),
	array('label'=>'Crear AwardDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar AwardDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar AwardDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar AwardDocuments', 'url'=>array('admin')),
);
?>

<h1>View AwardDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idAdjudicacion',
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
