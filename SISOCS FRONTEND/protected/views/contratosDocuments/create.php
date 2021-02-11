<?php
/* @var $this ContratosDocumentsController */
/* @var $model ContratosDocuments */

$this->breadcrumbs=array(
	'Contratos Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ContratosDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar ContratosDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear ContratosDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>