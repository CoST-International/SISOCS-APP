<?php
/* @var $this FinalizacionDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Finalizacion Documents',
);

$this->menu=array(
	array('label'=>'Crear FinalizacionDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar FinalizacionDocuments', 'url'=>array('admin')),
);
?>

<h1>Finalizacion Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
