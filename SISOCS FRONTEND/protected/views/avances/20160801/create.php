<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	array('label'=>'Administrar Avances', 'url'=>array('admin2','id'=>Yii::app()->getSession()->get('idInicioEjecucion'))),
);
?>

<h1>Crear avances en la ejecuci&oacute;n</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'model3'=>$model3,'idInicioEjecucion'=>$idInicioEjecucion,)); ?>