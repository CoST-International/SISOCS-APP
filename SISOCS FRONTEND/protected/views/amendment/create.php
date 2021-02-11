<?php
/* @var $this AmendmentController */
/* @var $model Amendment */

$this->breadcrumbs=array(
	'Amendments'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Amendment', 'url'=>array('index')),
	array('label'=>'Gestionar Amendment', 'url'=>array('admin')),
);
?>

<h1>Crear Amendment</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>