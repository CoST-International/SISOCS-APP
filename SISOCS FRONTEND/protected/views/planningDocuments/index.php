<?php
/* @var $this PlanningDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Planning Documents',
);

$this->menu=array(
	array('label'=>'Crear PlanningDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar PlanningDocuments', 'url'=>array('admin')),
);
?>

<h1>Planning Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
