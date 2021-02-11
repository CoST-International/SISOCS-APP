<?php
/* @var $this TariffsController */
/* @var $model Tariffs */

$this->breadcrumbs=array(
	'Tariffs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Tariffs', 'url'=>array('index')),
	array('label'=>'Crear Tariffs', 'url'=>array('create')),
	array('label'=>'View Tariffs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Tariffs', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tariffs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>