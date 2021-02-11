<?php
/* @var $this TransactionsController */
/* @var $model Transactions */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Transactions', 'url'=>array('index')),
	array('label'=>'Gestionar Transactions', 'url'=>array('admin')),
);
?>

<h1>Crear Transactions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
