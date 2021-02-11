<?php
/* @var $this AnnouncementController */
/* @var $model Anuncio */

$this->breadcrumbs=array(
	'Announcements'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Anuncio', 'url'=>array('index')),
	array('label'=>'Crear Anuncio', 'url'=>array('create')),
	array('label'=>'Ver Anuncio', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Anuncio', 'url'=>array('admin')),
);
?>

<h1>Update Anuncio <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>