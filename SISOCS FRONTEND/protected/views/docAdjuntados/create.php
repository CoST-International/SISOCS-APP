<?php
/* @var $this DocAdjuntadosController */
/* @var $model DocAdjuntados */

$this->breadcrumbs=array(
	'Doc Adjuntadoses'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar DocAdjuntados', 'url'=>array('index')),
	array('label'=>'Gestionar DocAdjuntados', 'url'=>array('admin')),
);
?>

<h1>Crear DocAdjuntados</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>