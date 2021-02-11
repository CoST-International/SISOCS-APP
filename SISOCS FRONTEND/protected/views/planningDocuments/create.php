<?php
/* @var $this PlanningDocumentsController */
/* @var $model PlanningDocuments */

$this->breadcrumbs=array(
	'Planning Documents'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar PlanningDocuments', 'url'=>array('index')),
	array('label'=>'Gestionar PlanningDocuments', 'url'=>array('admin')),
);
?>

<h1>Crear PlanningDocuments</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'idProyecto'=>$idProyecto)); ?>
