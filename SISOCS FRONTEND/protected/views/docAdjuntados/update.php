<?php
/* @var $this DocAdjuntadosController */
/* @var $model DocAdjuntados */

$this->breadcrumbs=array(
	'Doc Adjuntadoses'=>array('index'),
	$model->codigo=>array('view','id'=>$model->codigo),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar DocAdjuntados', 'url'=>array('index')),
	array('label'=>'Crear DocAdjuntados', 'url'=>array('create')),
	array('label'=>'View DocAdjuntados', 'url'=>array('view', 'id'=>$model->codigo)),
	array('label'=>'Gestionar DocAdjuntados', 'url'=>array('admin')),
);
?>

<h1>Actualizar DocAdjuntados <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'cod_inicio_ejecucion'=>$cod_inicio_ejecucion,)); ?>