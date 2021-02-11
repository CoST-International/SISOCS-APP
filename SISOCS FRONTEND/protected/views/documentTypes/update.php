<?php
/* @var $this DocumentTypesController */
/* @var $model DocumentTypes */

$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	$model->idDocumentType=>array('view','id'=>$model->idDocumentType),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar DocumentTypes', 'url'=>array('index')),
	array('label'=>'Crear DocumentTypes', 'url'=>array('create')),
	array('label'=>'View DocumentTypes', 'url'=>array('view', 'id'=>$model->idDocumentType)),
	array('label'=>'Gestionar DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>Actualizar DocumentTypes <?php echo $model->idDocumentType; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>