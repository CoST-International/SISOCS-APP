<?php
/* @var $this TransactionsController */
/* @var $model Transactions */

$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Transactions', 'url'=>array('index')),
	array('label'=>'Crear Transactions', 'url'=>array('create')),
	array('label'=>'View Transactions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Transactions', 'url'=>array('admin')),
);
?>

<h1>Actualizar Transactions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>