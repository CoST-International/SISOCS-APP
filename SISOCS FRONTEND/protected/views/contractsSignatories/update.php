<?php
/* @var $this ContractsSignatoriesController */
/* @var $model ContractsSignatories */

$this->breadcrumbs=array(
	'Contracts Signatories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ContractsSignatories', 'url'=>array('index')),
	array('label'=>'Crear ContractsSignatories', 'url'=>array('create')),
	array('label'=>'View ContractsSignatories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Gestionar ContractsSignatories', 'url'=>array('admin')),
);
?>

<h1>Actualizar ContractsSignatories <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>