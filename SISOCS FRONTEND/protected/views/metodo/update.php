<?php
/* @var $this MetodoController */
/* @var $model Metodo */

$this->breadcrumbs=array(
	'Metodos'=>array('index'),
	$model->idMetodo=>array('view','id'=>$model->idMetodo),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Metodo', 'url'=>array('index')),
	array('label'=>'Crear Metodo', 'url'=>array('create')),
	array('label'=>'View Metodo', 'url'=>array('view', 'id'=>$model->idMetodo)),
	array('label'=>'Gestionar Metodo', 'url'=>array('admin')),
);
?>

<h1>Actualizar Metodo <?php echo $model->idMetodo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
