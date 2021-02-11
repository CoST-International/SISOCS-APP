<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->idAvances=>array('view','id'=>$model->idAvances),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Ver Avances', 'url'=>array('view', 'id'=>$model->idAvances)),
	array('label'=>'Administrar Avances', 'url'=>array('admin2','id'=>Yii::app()->getSession()->get('idInicioEjecucion'))),
);
?>

<h1>Actualizar Avances en la Ejecuci&oacute;n <?php echo $model->idAvances; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'model3'=>$model3,'idInicioEjecucion'=>$idInicioEjecucion)); ?>