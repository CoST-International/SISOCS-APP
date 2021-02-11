<?php
/* @var $this FinalizacionDocumentsController */
/* @var $model FinalizacionDocuments */

$this->breadcrumbs=array(
	'Finalizacion Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar FinalizacionDocuments', 'url'=>array('index')),
	array('label'=>'Crear FinalizacionDocuments', 'url'=>array('create')),
	array('label'=>'View FinalizacionDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar FinalizacionDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar FinalizacionDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>