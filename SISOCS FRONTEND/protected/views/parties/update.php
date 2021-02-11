<?php
/* @var $this PartiesController */
/* @var $model Parties */

$this->breadcrumbs=array(
	'Parties'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Parties', 'url'=>array('index')),
	array('label'=>'Crear Parties', 'url'=>array('create')),
	array('label'=>'View Parties', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Parties', 'url'=>array('admin')),
);
?>

<h1>Actualizar Parties <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>