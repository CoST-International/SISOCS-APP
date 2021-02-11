<?php
/* @var $this FuentesfinanController */
/* @var $model Fuentesfinan */

$this->breadcrumbs=array(
	//'Fuentesfinans'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Fuentes de Financiamiento', 'url'=>array('index')),
	array('label'=>'Administrar Fuentes de Financiamiento', 'url'=>array('admin')),
);
?>

<h1>Crear Fuente de Financiamiento</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
