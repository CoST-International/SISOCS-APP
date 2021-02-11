<?php
/* @var $this TipocontratoController */
/* @var $model Tipocontrato */

$this->breadcrumbs=array(
	//'Tipocontratos'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Tipocontrato', 'url'=>array('index')),
	array('label'=>'Gestionar Tipocontrato', 'url'=>array('admin')),
);
?>

<h1>Crear Tipocontrato</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
