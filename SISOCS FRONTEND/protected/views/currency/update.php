<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	$model->idCurrency=>array('view','id'=>$model->idCurrency),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Currency', 'url'=>array('index')),
	array('label'=>'Crear Currency', 'url'=>array('create')),
	array('label'=>'View Currency', 'url'=>array('view', 'id'=>$model->idCurrency)),
	array('label'=>'Gestionar Currency', 'url'=>array('admin')),
);
?>

<h1>Actualizar Currency <?php echo $model->idCurrency; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>