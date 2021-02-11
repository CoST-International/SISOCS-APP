<?php
/* @var $this ContratacionController */
/* @var $model Contratacion */

$this->breadcrumbs=array(
	'Contrataciones'=>array('index'),
	$model->idContratacion=>array('view','id'=>$model->idContratacion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Contrataciones (Publicadas)', 'url'=>array('index')),
	array('label'=>'Crear Contratación', 'url'=>array('create')),
	array('label'=>'Ver Contratación', 'url'=>array('view', 'id'=>$model->idContratacion)),
	array('label'=>'Gestionar Contrataciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Contratación <?php echo $model->ncontrato; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>