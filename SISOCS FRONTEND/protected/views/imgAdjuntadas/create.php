<?php
/* @var $this ImgAdjuntadasController */
/* @var $model ImgAdjuntadas */

$this->breadcrumbs=array(
	'Img Adjuntadases'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ImgAdjuntadas', 'url'=>array('index')),
	array('label'=>'Gestionar ImgAdjuntadas', 'url'=>array('admin')),
);
?>

<h1>Crear ImgAdjuntadas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>