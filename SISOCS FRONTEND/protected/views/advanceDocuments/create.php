<?php
/* @var $this AdvanceDocumentsController */
/* @var $model AdvanceDocuments */

$this->breadcrumbs=array(
	'Advance Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar AdvanceDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar AdvanceDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear AdvanceDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>