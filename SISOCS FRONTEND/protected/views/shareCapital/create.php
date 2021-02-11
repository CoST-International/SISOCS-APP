<?php
/* @var $this ShareCapitalController */
/* @var $model ShareCapital */

$this->breadcrumbs=array(
	'Share Capitals'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ShareCapital', 'url'=>array('index')),
	array('label'=>'Gestionar ShareCapital', 'url'=>array('admin')),
);
?>

<h1>Crear ShareCapital</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>