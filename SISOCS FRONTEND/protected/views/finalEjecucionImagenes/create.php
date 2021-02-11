<?php
/* @var $this FinalEjecucionImagenesController */
/* @var $model FinalEjecucionImagenes */

$this->breadcrumbs=array(
	'Final Ejecucion Imagenes'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar FinalEjecucionImagenes', 'url'=>array('index')),
	array('label'=>'Gestionar FinalEjecucionImagenes', 'url'=>array('admin')),
);
?>

<h1>Crear FinalEjecucionImagenes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>