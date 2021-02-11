<?php
/* @var $this EntesController */
/* @var $model Entes */

$this->breadcrumbs=array(
	//'Entes'=>array('index'),
	//$model->idEnte=>array('view','id'=>$model->idEnte),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Entes', 'url'=>array('index')),
	array('label'=>'Crear Entes', 'url'=>array('create')),
	//array('label'=>'Ver Entes', 'url'=>array('view', 'id'=>$model->idEnte)),
	array('label'=>'Gestionar Entes', 'url'=>array('admin')),
);
?>

<h1>Actualizar Ente <?php echo $model->idEnte; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
