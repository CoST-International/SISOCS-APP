<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->idAvances=>array('view','id'=>$model->idAvances),
	'Actualizar',
);
/*
$this->menu=array(
	array('label'=>'Administrar otros Avances de la Ejecución #'.$idInicioEjecucion, 'url'=>array('admin','id'=>Yii::app()->getSession()->get('idInicioEjecucion')))
);*/

$this->menu=array(
		array('label'=>'Administrar otros Avances de la Ejecución #'.$idInicioEjecucion, 'url'=>array('admin','id'=>$idInicioEjecucion))
);
?>

<h1>Actualizando Avance #<?php echo $model->idAvances; ?> de la Ejecuci&oacute;n <?php echo $idInicioEjecucion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'model3'=>$model3, 'idInicioEjecucion'=>$idInicioEjecucion)); ?>
