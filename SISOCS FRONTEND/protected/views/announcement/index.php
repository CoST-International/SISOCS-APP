<?php
/* @var $this AnnouncementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Announcements',
);

$this->menu=array(
	array('label'=>'Crear Anuncio', 'url'=>array('create')),
	array('label'=>'Administrar Anuncio', 'url'=>array('admin')),
);
?>

<h1>Announcements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
