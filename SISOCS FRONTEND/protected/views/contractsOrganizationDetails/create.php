<?php
/* @var $this ContractsOrganizationDetailsController */
/* @var $model ContractsOrganizationDetails */

$this->breadcrumbs=array(
	'Contracts Organization Details'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ContractsOrganizationDetails', 'url'=>array('index')),
	array('label'=>'Gestionar ContractsOrganizationDetails', 'url'=>array('admin')),
);
?>

<h1>Crear ContractsOrganizationDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>