<?php
/* @var $this TariffsController */
/* @var $model Tariffs */

$this->breadcrumbs=array(
	'Tariffs'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Tariffs', 'url'=>array('index')),
	array('label'=>'Gestionar Tariffs', 'url'=>array('admin')),
);
?>

<h1>Crear Tariffs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>