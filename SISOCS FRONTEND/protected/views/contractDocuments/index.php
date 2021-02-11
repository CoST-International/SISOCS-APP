<?php
/* @var $this ContractDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contract Documents',
);

$this->menu=array(
	array('label'=>'Crear ContractDocuments', 'url'=>array('create')),
	array('label'=>'Gestionar ContractDocuments', 'url'=>array('admin')),
);
?>

<h1>Contract Documents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
