<?php
/* @var $this MonedasController */
/* @var $model Monedas */

$this->breadcrumbs=array(
	'Monedases'=>array('index'),
	$model->idMoneda=>array('view','id'=>$model->idMoneda),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Monedas', 'url'=>array('index')),
	array('label'=>'Crear Monedas', 'url'=>array('create')),
	array('label'=>'Ver Monedas', 'url'=>array('view', 'id'=>$model->idMoneda)),
	array('label'=>'Administrar Monedas', 'url'=>array('admin')),
);
?>

<h1>Actualizar Monedas <?php echo $model->idMoneda; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>