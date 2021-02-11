<?php
/* @var $this ContractDocumentsController */
/* @var $model ContractDocuments */

$this->breadcrumbs=array(
	'Contract Documents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar ContractDocuments', 'url'=>array('index')),
	array('label'=>'Crear ContractDocuments', 'url'=>array('create')),
	array('label'=>'Actualizar ContractDocuments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ContractDocuments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ContractDocuments', 'url'=>array('admin')),
);
?>

<h1>View ContractDocuments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
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
