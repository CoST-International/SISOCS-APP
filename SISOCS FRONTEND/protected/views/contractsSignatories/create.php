<?php
/* @var $this ContractsSignatoriesController */
/* @var $model ContractsSignatories */

$this->breadcrumbs=array(
	'Contracts Signatories'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ContractsSignatories', 'url'=>array('index')),
	array('label'=>'Gestionar ContractsSignatories', 'url'=>array('admin')),
);
?>

<h1>Crear ContractsSignatories</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>