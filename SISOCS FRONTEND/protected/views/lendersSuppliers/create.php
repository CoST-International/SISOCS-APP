<?php
/* @var $this LendersSuppliersController */
/* @var $model LendersSuppliers */

$this->breadcrumbs=array(
	'Lenders Suppliers'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar LendersSuppliers', 'url'=>array('index')),
	array('label'=>'Gestionar LendersSuppliers', 'url'=>array('admin')),
);
?>

<h1>Crear LendersSuppliers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>