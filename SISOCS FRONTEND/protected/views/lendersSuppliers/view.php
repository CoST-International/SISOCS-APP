<?php
/* @var $this LendersSuppliersController */
/* @var $model LendersSuppliers */

$this->breadcrumbs=array(
	'Lenders Suppliers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar LendersSuppliers', 'url'=>array('index')),
	array('label'=>'Crear LendersSuppliers', 'url'=>array('create')),
	array('label'=>'Actualizar LendersSuppliers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar LendersSuppliers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar este elemento?')),
	array('label'=>'Gestionar LendersSuppliers', 'url'=>array('admin')),
);
?>

<h1>View LendersSuppliers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idContratacion',
		'shareholder_id',
		'shareholder_name',
		'votingRights',
		'votingRightsDetails',
		'shareholding',
	),
)); ?>
