<?php
/* @var $this EstadosgestcontraController */
/* @var $model Estadosgestcontra */

$this->breadcrumbs=array(
	//'Estadosgestcontras'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Estados Gestión Contratos', 'url'=>array('index')),
	array('label'=>'Gestionar Estados Gestión Contratos', 'url'=>array('admin')),
);
?>

<h1>Crear Estadosgestcontra</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
