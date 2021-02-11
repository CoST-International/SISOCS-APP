<?php
/* @var $this AvancesController */
/* @var $model Avances */

$this->breadcrumbs=array(
	'Avances'=>array('index'),
	$model->codigo=>array('view','id'=>$model->codigo),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista Avances', 'url'=>array('index')),
	//array('label'=>'Crear Avances', 'url'=>array('create')),
	array('label'=>'Ver Avances', 'url'=>array('view', 'id'=>$model->codigo)),
	array('label'=>'Administrar Avances', 'url'=>array('admin')),
);
?>

<h1>Actualizar avances en la ejecuci&oacute;n <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2,'model3'=>$model3,'cod_inicio_ejecucion'=>$cod_inicio_ejecucion,)); ?>