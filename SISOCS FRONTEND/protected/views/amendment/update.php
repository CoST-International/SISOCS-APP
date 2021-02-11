<?php
/* @var $this AmendmentController */
/* @var $model Amendment */

$this->breadcrumbs=array(
	'Amendments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Amendment', 'url'=>array('index')),
	array('label'=>'Crear Amendment', 'url'=>array('create')),
	array('label'=>'View Amendment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Amendment', 'url'=>array('admin')),
);
?>

<h1>Actualizar Amendment <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'idContratacion'=>$idContratacion)); ?>
