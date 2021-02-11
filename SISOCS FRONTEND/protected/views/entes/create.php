<?php
/* @var $this EntesController */
/* @var $model Entes */

$this->breadcrumbs=array(
	//'Entes'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Entes', 'url'=>array('index')),
	array('label'=>'Gestionar Entes', 'url'=>array('admin')),
);
?>

<h1>Crear Entes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
