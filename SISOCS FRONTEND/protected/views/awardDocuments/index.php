<?php
/* @var $this AwardDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Award Documents',
);

$this->menu=array(
	array('label'=>'Crear AwardDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar AwardDocuments', 'url'=>array('admin')),
);
?>

<h1>Award Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
