<?php
/* @var $this ContratosDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contratos Documents',
);

$this->menu=array(
	array('label'=>'Crear ContratosDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar ContratosDocuments', 'url'=>array('admin')),
);
?>

<h1>Contratos Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
