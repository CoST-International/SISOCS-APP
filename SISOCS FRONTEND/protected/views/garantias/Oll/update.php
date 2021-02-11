<?php
/* @var $this GarantiasController */
/* @var $model Garantias */

$this->breadcrumbs=array(
	'Garantiases'=>array('index'),
	$model->idGarantia=>array('view','id'=>$model->idGarantia),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Garantias', 'url'=>array('index')),
	array('label'=>'Crear Garantias', 'url'=>array('create')),
	array('label'=>'View Garantias', 'url'=>array('view', 'id'=>$model->idGarantia)),
	array('label'=>'Gestionar Garantias', 'url'=>array('admin')),
);
?>

<h1>Actualizar Garantias <?php echo $model->idGarantia; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>