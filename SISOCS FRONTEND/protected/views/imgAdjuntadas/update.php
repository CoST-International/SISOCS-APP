<?php
/* @var $this ImgAdjuntadasController */
/* @var $model ImgAdjuntadas */

$this->breadcrumbs=array(
	'Img Adjuntadases'=>array('index'),
	$model->codigo=>array('view','id'=>$model->codigo),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ImgAdjuntadas', 'url'=>array('index')),
	array('label'=>'Crear ImgAdjuntadas', 'url'=>array('create')),
	array('label'=>'View ImgAdjuntadas', 'url'=>array('view', 'id'=>$model->codigo)),
	array('label'=>'Gestionar ImgAdjuntadas', 'url'=>array('admin')),
);
?>

<h1>Actualizar ImgAdjuntadas <?php echo $model->codigo; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'cod_inicio_ejecucion'=>$cod_inicio_ejecucion,)); ?>