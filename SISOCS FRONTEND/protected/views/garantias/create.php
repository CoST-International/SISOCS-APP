<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantias'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	array('label'=>'Gestion Garantias', 'url'=>array('admin','id'=>Yii::app()->getSession()->get('idInicioEjecucion'))),
);
?>

<h1>Crear Garantias</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'idInicioEjecucion'=>$idInicioEjecucion)); ?>