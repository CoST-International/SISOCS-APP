<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
	'Currencies'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Currency', 'url'=>array('index')),
	array('label'=>'Gestionar Currency', 'url'=>array('admin')),
);
?>

<h1>Crear Currency</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>