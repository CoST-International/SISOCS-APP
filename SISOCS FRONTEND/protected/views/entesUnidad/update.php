<?php
/* @var $this EntesUnidadController */
/* @var $model EntesUnidad */

$this->breadcrumbs=array(
	//'Entes Unidads'=>array('index'),
	//$model->idUnidad=>array('view','id'=>$model->idUnidad),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar EntesUnidad', 'url'=>array('index')),
	array('label'=>'Crear EntesUnidad', 'url'=>array('create')),
	//array('label'=>'Ver EntesUnidad', 'url'=>array('view', 'idUnidad'=>$model->idUnidad,'idEnte'=>$model->idEnte)),
	array('label'=>'Gestionar EntesUnidad', 'url'=>array('admin')),
);
?>

<h1>Actualizar EntesUnidad <?php echo $model->idUnidad; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
