<?php
/* @var $this ShareCapitalController */
/* @var $model ShareCapital */

$this->breadcrumbs=array(
	'Share Capitals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ShareCapital', 'url'=>array('index')),
	array('label'=>'Crear ShareCapital', 'url'=>array('create')),
	array('label'=>'View ShareCapital', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ShareCapital', 'url'=>array('admin')),
);
?>

<h1>Actualizar ShareCapital <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>