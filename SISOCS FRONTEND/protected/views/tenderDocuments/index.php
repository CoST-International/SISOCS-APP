<?php
/* @var $this TenderDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tender Documents',
);

$this->menu=array(
	array('label'=>'Crear TenderDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar TenderDocuments', 'url'=>array('admin')),
);
?>

<h1>Tender Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
