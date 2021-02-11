<?php
/* @var $this MonedasController */
/* @var $model Monedas */

$this->breadcrumbs=array(
	'Monedases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Monedas', 'url'=>array('index')),
	array('label'=>'Administrar Monedas', 'url'=>array('admin')),
);
?>

<h1>Crear Monedas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>