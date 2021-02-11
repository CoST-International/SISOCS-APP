<?php
/* @var $this RegionController */
/* @var $model Region */

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->idRegion=>array('view','id'=>$model->idRegion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Region', 'url'=>array('index')),
	array('label'=>'Crear Region', 'url'=>array('create')),
	array('label'=>'View Region', 'url'=>array('view', 'id'=>$model->idRegion)),
	array('label'=>'Gestionar Region', 'url'=>array('admin')),
);
?>

<h1>Actualizar Region <?php echo $model->idRegion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>