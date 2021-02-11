<?php
/* @var $this InicioEjecucionController */
/* @var $model InicioEjecucion */

$this->breadcrumbs=array(
	'Implementacion'=>array('index'),
	$model->idInicioEjecucion=>array('view','id'=>$model->idInicioEjecucion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista de Implementación (Publicados)', 'url'=>array('index')),
	array('label'=>'Crear Implementación', 'url'=>array('create')),
	array('label'=>'Ver Implementación', 'url'=>array('view', 'id'=>$model->idInicioEjecucion)),
	array('label'=>'Gestionar Implementación', 'url'=>array('admin')),
);
?>

<h1>Actualizar Datos generales de la ejecución </h1>
<h1><?php echo $model->idContratacion0["titulocontrato"]; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
