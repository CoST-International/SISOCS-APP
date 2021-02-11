<?php
/* @var $this FinalEjecucionImagenesController */
/* @var $model FinalEjecucionImagenes */

$this->breadcrumbs=array(
	'Final Ejecucion Imagenes'=>array('index'),
	$model->idImagen=>array('view','id'=>$model->idImagen),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar FinalEjecucionImagenes', 'url'=>array('index')),
	array('label'=>'Crear FinalEjecucionImagenes', 'url'=>array('create')),
	array('label'=>'View FinalEjecucionImagenes', 'url'=>array('view', 'id'=>$model->idImagen)),
	array('label'=>'Gestionar FinalEjecucionImagenes', 'url'=>array('admin')),
);
?>

<h1>Actualizar FinalEjecucionImagenes <?php echo $model->idImagen; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>