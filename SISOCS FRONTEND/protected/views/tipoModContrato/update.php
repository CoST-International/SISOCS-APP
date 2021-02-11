<?php
/* @var $this TipoModContratoController */
/* @var $model TipoModContrato */

$this->breadcrumbs=array(
	//'Tipo Mod Contratos'=>array('index'),
	//$model->idTipoModificacion=>array('view','id'=>$model->idTipoModificacion),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar TipoModContrato', 'url'=>array('index')),
	array('label'=>'Crear TipoModContrato', 'url'=>array('create')),
	//array('label'=>'View TipoModContrato', 'url'=>array('view', 'id'=>$model->idTipoModificacion)),
	array('label'=>'Gestionar TipoModContrato', 'url'=>array('admin')),
);
?>

<h1>Actualizar TipoModContrato <?php echo $model->idTipoModificacion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
