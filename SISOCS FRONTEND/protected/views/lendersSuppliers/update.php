<?php
/* @var $this LendersSuppliersController */
/* @var $model LendersSuppliers */

$this->breadcrumbs=array(
	'Lenders Suppliers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar LendersSuppliers', 'url'=>array('index')),
	array('label'=>'Crear LendersSuppliers', 'url'=>array('create')),
	array('label'=>'View LendersSuppliers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar LendersSuppliers', 'url'=>array('admin')),
);
?>

<h1>Actualizar LendersSuppliers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>