<?php
/* @var $this EstadosgestcontraController */
/* @var $model Estadosgestcontra */

$this->breadcrumbs=array(
	//'Estadosgestcontras'=>array('index'),
	//$model->idEstadoGesion=>array('view','id'=>$model->idEstadoGesion),
	'Actualizar',
);

$this->menu=array(
	//array('label'=>'Listar Estados Gestión Contratos', 'url'=>array('index')),
	array('label'=>'Crear Estados Gestión Contratos', 'url'=>array('create')),
	//array('label'=>'Ver Estados Gestión Contratos', 'url'=>array('view', 'id'=>$model->idEstadoGesion)),
	array('label'=>'Gestionar Estados Gestión Contratos', 'url'=>array('admin')),
);
?>

<h1>Actualizar Estadosgestcontra <?php echo $model->idEstadoGesion; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
