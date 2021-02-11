<?php
/* @var $this TransactionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transactions',
);

$this->menu=array(
	array('label'=>'Crear Transactions', 'url'=>array('create')),
	array('label'=>'Gestionar Transactions', 'url'=>array('admin')),
);
?>

<h1>Transactions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
