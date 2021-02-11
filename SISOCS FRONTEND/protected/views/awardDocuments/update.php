<?php
/* @var $this AwardDocumentsController */
/* @var $model AwardDocuments */

$this->breadcrumbs=array(
	'Award Documents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar AwardDocuments', 'url'=>array('index')),
	array('label'=>'Crear AwardDocuments', 'url'=>array('create')),
	array('label'=>'View AwardDocuments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar AwardDocuments', 'url'=>array('admin')),
);
?>

<h1>Actualizar AwardDocuments <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>