<?php
/* @var $this AnnouncementController */
/* @var $model Anuncio */

$this->breadcrumbs=array(
	'Announcements'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Anuncio', 'url'=>array('index')),
	array('label'=>'Administrar Anuncio', 'url'=>array('admin')),
);
?>

<h1>Crear Anuncio</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>