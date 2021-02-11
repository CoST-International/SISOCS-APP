<?php
/* @var $this ImplementationDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Implementation Documents',
);

$this->menu=array(
	array('label'=>'Crear ImplementationDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar ImplementationDocuments', 'url'=>array('admin')),
);
?>

<h1>Implementation Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
