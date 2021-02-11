<?php
/* @var $this ContractsSignatoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contracts Signatories',
);

$this->menu=array(
	array('label'=>'Crear ContractsSignatories', 'url'=>array('create')),
	array('label'=>'Gestionar ContractsSignatories', 'url'=>array('admin')),
);
?>

<h1>Contracts Signatories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
