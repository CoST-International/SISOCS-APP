<?php
/* @var $this DocumentTypesController */
/* @var $model DocumentTypes */

$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	$model->idDocumentType,
);

$this->menu=array(
	array('label'=>'Listar DocumentTypes', 'url'=>array('index')),
	array('label'=>'Crear DocumentTypes', 'url'=>array('create')),
	array('label'=>'Actualizar DocumentTypes', 'url'=>array('update', 'id'=>$model->idDocumentType)),
	array('label'=>'Eliminar DocumentTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idDocumentType),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>View DocumentTypes #<?php echo $model->idDocumentType; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idDocumentType',
        'code',
        'title',
		'description',
	),
)); ?>
