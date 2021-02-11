<?php
/* @var $this ContractsOrganizationDetailsController */
/* @var $model ContractsOrganizationDetails */

$this->breadcrumbs=array(
	'Contracts Organization Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ContractsOrganizationDetails', 'url'=>array('index')),
	array('label'=>'Crear ContractsOrganizationDetails', 'url'=>array('create')),
	array('label'=>'View ContractsOrganizationDetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ContractsOrganizationDetails', 'url'=>array('admin')),
);
?>

<h1>Actualizar ContractsOrganizationDetails <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>