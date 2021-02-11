<?php
/* @var $this AdvanceDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Advance Documents',
);

$this->menu=array(
	array('label'=>'Crear AdvanceDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar AdvanceDocuments', 'url'=>array('admin')),
);
?>

<h1>Advance Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
