<?php
/* @var $this ShareholdersController */
/* @var $model Shareholders */

$this->breadcrumbs=array(
	'Shareholders'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Shareholders', 'url'=>array('index')),
	array('label'=>'Gestionar Shareholders', 'url'=>array('admin')),
);
?>

<h1>Crear Shareholders</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>