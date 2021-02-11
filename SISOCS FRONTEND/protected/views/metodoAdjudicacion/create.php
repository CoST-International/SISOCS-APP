<?php
/* @var $this MetodoAdjudicacionController */
/* @var $model MetodoAdjudicacion */

$this->breadcrumbs=array(
	//'Metodo Adjudicacions'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar MetodoAdjudicacion', 'url'=>array('index')),
	array('label'=>'Gestionar MetodoAdjudicacion', 'url'=>array('admin')),
);
?>

<h1>Crear Método de Adjudicación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
