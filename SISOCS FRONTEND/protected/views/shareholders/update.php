<?php
/* @var $this ShareholdersController */
/* @var $model Shareholders */

$this->breadcrumbs=array(
	'Shareholders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Shareholders', 'url'=>array('index')),
	array('label'=>'Crear Shareholders', 'url'=>array('create')),
	array('label'=>'View Shareholders', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar Shareholders', 'url'=>array('admin')),
);
?>

<h1>Actualizar Shareholders <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>