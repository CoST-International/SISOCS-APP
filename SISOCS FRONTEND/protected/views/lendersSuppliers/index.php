<?php
/* @var $this LendersSuppliersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lenders Suppliers',
);

$this->menu=array(
	array('label'=>'Crear LendersSuppliers', 'url'=>array('create')),
	array('label'=>'Gestionar LendersSuppliers', 'url'=>array('admin')),
);
?>

<h1>Lenders Suppliers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
