<?php
/* @var $this PrequalificationController */
/* @var $model Prequalification */

$this->breadcrumbs=array(
	'Prequalifications'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Prequalification', 'url'=>array('index')),
	array('label'=>'Crear Prequalification', 'url'=>array('create')),
	array('label'=>'View Prequalification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Prequalification', 'url'=>array('admin')),
);
?>

<h1>Actualizar Prequalification <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'id'=>$id, 'iDP'=>$idProyecto)); ?>
