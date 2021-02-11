<?php
/* @var $this EstadoController */
/* @var $model Estado */

$this->breadcrumbs=array(
	//'Estados'=>array('index'),
	//$model->estado=>array('view','id'=>$model->estado),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Estado', 'url'=>array('index')),
	array('label'=>'Crear Estado', 'url'=>array('create')),
	//array('label'=>'Ver Estado', 'url'=>array('view', 'id'=>$model->estado)),
	array('label'=>'Gestionar Estado', 'url'=>array('admin')),
);
?>

<h1>Actualizar Estado <?php echo $model->estado; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
