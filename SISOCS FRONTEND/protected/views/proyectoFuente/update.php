<?php
/* @var $this ProgramaFuenteController */
/* @var $model ProgramaFuente */

$this->breadcrumbs=array(
	'Programa Fuentes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Lista Programa Fuente', 'url'=>array('index')),
	array('label'=>'Creaar Programa Fuente', 'url'=>array('create')),
	array('label'=>'Ver Programa Fuente', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Administrar Programa Fuente', 'url'=>array('admin')),
);
?>

<h1>Actualizar Programa de Fuente <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>