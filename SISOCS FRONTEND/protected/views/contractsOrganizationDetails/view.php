<?php
/* @var $this ContractsOrganizationDetailsController */
/* @var $model ContractsOrganizationDetails */

$this->breadcrumbs=array(
	'Contracts Organization Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar ContractsOrganizationDetails', 'url'=>array('index')),
	array('label'=>'Crear ContractsOrganizationDetails', 'url'=>array('create')),
	array('label'=>'Actualizar ContractsOrganizationDetails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar ContractsOrganizationDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar ContractsOrganizationDetails', 'url'=>array('admin')),
);
?>

<h1>View ContractsOrganizationDetails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'parties_id',
	),
)); ?>
