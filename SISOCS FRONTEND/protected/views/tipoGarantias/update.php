<?php
/* @var $this TipoGarantiasController */
/* @var $model TipoGarantias */

$this->breadcrumbs=array(
	'Tipo Garantiases'=>array('index'),
	$model->idTipoGarantia=>array('view','id'=>$model->idTipoGarantia),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar TipoGarantias', 'url'=>array('index')),
	array('label'=>'Crear TipoGarantias', 'url'=>array('create')),
	array('label'=>'View TipoGarantias', 'url'=>array('view', 'id'=>$model->idTipoGarantia)),
	array('label'=>'Gestionar TipoGarantias', 'url'=>array('admin')),
);
?>

<h1>Actualizar TipoGarantias <?php echo $model->idTipoGarantia; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>