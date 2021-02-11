<?php
/* @var $this LocalityController */
/* @var $model Locality */

$this->breadcrumbs=array(
	'Localities'=>array('index'),
	$model->idLocality=>array('view','id'=>$model->idLocality),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Locality', 'url'=>array('index')),
	array('label'=>'Crear Locality', 'url'=>array('create')),
	array('label'=>'View Locality', 'url'=>array('view', 'id'=>$model->idLocality)),
	array('label'=>'Gestionar Locality', 'url'=>array('admin')),
);
?>

<h1>Actualizar Locality <?php echo $model->idLocality; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>