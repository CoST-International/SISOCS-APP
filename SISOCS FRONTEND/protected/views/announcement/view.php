<?php
/* @var $this AnnouncementController */
/* @var $model Anuncio */

$this->breadcrumbs=array(
	'Announcements'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Listar Anuncio', 'url'=>array('index')),
	array('label'=>'Crear Anuncio', 'url'=>array('create')),
	array('label'=>'Update Anuncio', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Anuncio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Administrar Anuncio', 'url'=>array('admin')),
);
?>

<h1>Ver Anuncio #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'date',
		'idProyecto',
	),
)); ?>
