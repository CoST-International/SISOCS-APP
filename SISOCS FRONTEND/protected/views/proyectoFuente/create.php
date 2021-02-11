<?php
/* @var $this ProgramaFuenteController */
/* @var $model ProgramaFuente */

$this->breadcrumbs=array(
	//'Programa Fuentes'=>array('index'),
	'Crear',
);

$this->menu=array(
	//array('label'=>'Listar Programa Fuente', 'url'=>array('index')),
	//array('label'=>'Administrar Programa Fuente', 'url'=>array('admin')),
);
?>

<h1>Agregar Fuente al Proyecto</h1>

<?php $this->renderPartial('_formajax', array('model'=>$model)); ?>
