<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar otros Avances de la Ejecución #'.$idInicioEjecucion, 'url'=>array('admin','id'=>$idInicioEjecucion)),
);
?>

<h1>Crear avances en la ejecuci&oacute;n</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model3'=>$model3,'idInicioEjecucion'=>$idInicioEjecucion,)); ?>
