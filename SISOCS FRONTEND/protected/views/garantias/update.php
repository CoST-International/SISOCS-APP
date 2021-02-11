<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantias'=>array('index'),
	$model->idGarantia=>array('view','id'=>$model->idGarantia),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	array('label'=>'Crear Garantia', 'url'=>Yii::app()->createUrl("/garantias/create", array("idInicioEjecucion"=>$model->idInicioEjecucion))),
	array('label'=>'Ver Garantias', 'url'=>array('view', 'id'=>$model->idInicioEjecucion)),
	array('label'=>'Gestion Garantias', 'url'=>array('admin','id'=>Yii::app()->getSession()->get('idInicioEjecucion'))),
);
?>

<h1>Actualizar Garantias <?php echo $model->idGarantia; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>