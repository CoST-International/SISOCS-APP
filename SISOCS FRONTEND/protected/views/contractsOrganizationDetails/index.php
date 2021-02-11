<?php
/* @var $this ContractsOrganizationDetailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contracts Organization Details',
);

$this->menu=array(
	array('label'=>'Crear ContractsOrganizationDetails', 'url'=>array('create')),
	array('label'=>'Gestionar ContractsOrganizationDetails', 'url'=>array('admin')),
);
?>

<h1>Contracts Organization Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
