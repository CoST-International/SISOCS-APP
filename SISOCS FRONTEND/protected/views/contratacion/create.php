<?php
/* @var $this ContratacionController */
/* @var $model Contratacion */

$this->breadcrumbs=array(
	'Contrataciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Contrataciones (Publicadas)', 'url'=>array('index')),
	array('label'=>'Gestionar Contrataciones', 'url'=>array('admin')),
);
?>

<h1>Contratación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>