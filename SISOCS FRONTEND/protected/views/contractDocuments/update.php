<?php
/* @var $this ContractDocumentsController */
/* @var $model ContractDocuments */

$this->breadcrumbs=array(
	'Contract Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ContractDocuments', 'url'=>array('index')),
	array('label'=>'Crear ContractDocuments', 'url'=>array('create')),
	array('label'=>'View ContractDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ContractDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar ContractDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>