<?php
/* @var $this ImplementationDocumentsController */
/* @var $model ImplementationDocuments */

$this->breadcrumbs=array(
	'Implementation Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ImplementationDocuments', 'url'=>array('index')),
	array('label'=>'Crear ImplementationDocuments', 'url'=>array('create')),
	array('label'=>'View ImplementationDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ImplementationDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar ImplementationDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>