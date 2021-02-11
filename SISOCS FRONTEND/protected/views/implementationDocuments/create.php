<?php
/* @var $this ImplementationDocumentsController */
/* @var $model ImplementationDocuments */

$this->breadcrumbs=array(
	'Implementation Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ImplementationDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar ImplementationDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear ImplementationDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>