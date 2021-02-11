<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs=array(
	'Implementacion'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Lista de Implementación (Publicados)', 'url'=>array('index')),
	array('label'=>'Administrar Implementación', 'url'=>array('admin')),
);
?>

<h1>Inicio de la Ejecución</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
