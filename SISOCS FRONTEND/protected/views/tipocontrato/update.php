<?php
/* @var $this TipocontratoController */
/* @var $model Tipocontrato */

$this->breadcrumbs=array(
	//'Tipocontratos'=>array('index'),
	//$model->idTipoContrato=>array('view','id'=>$model->idTipoContrato),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Tipocontrato', 'url'=>array('index')),
	array('label'=>'Crear Tipocontrato', 'url'=>array('create')),
	//array('label'=>'Ver Tipocontrato', 'url'=>array('view', 'id'=>$model->idTipoContrato)),
	array('label'=>'Gestionar Tipocontrato', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipocontrato <?php echo $model->idTipoContrato; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
