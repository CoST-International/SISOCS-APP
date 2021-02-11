<?php
/* @var $this PropositoController */
/* @var $model Proposito */

$this->breadcrumbs=array(
	//'Propositos'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Proposito', 'url'=>array('index')),
	array('label'=>'Gestionar Proposito', 'url'=>array('admin')),
);
?>

<h1>Crear Proposito</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
