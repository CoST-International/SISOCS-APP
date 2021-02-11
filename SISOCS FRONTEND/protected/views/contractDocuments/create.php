<?php
/* @var $this ContractDocumentsController */
/* @var $model ContractDocuments */

$this->breadcrumbs=array(
	'Contract Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ContractDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar ContractDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear ContractDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>