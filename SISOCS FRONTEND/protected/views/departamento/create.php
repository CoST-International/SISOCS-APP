<?php
/* @var $this DepartamentoController */
/* @var $model Departamento */

$this->breadcrumbs=array(
	//'Departamentos'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listarar Departamentos', 'url'=>array('index')),
	array('label'=>'Administrar Departamento', 'url'=>array('admin')),
);
?>

<h1>Crear Departamento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
