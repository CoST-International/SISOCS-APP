<?php
/* @var $this FinalizacionDocumentsController */
/* @var $model FinalizacionDocuments */

$this->breadcrumbs=array(
	'Finalizacion Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar FinalizacionDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar FinalizacionDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear FinalizacionDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>