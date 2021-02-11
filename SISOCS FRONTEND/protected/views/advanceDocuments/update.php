<?php
/* @var $this AdvanceDocumentsController */
/* @var $model AdvanceDocuments */

$this->breadcrumbs=array(
	'Advance Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar AdvanceDocuments', 'url'=>array('index')),
	array('label'=>'Crear AdvanceDocuments', 'url'=>array('create')),
	array('label'=>'View AdvanceDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar AdvanceDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar AdvanceDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>