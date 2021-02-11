<?php
/* @var $this AdjudicacionController */
/* @var $model Adjudicacion */

$this->breadcrumbs=array(
	'Adjudicacioness'=>array('index'),
	$model->idAdjudicacion=>array('view','id'=>$model->idAdjudicacion),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Adjudicaciones (Publicadas)', 'url'=>array('index')),
	array('label'=>'Crear Adjudicación', 'url'=>array('create')),
	array('label'=>'Ver Adjudicación', 'url'=>array('view', 'id'=>$model->idAdjudicacion)),
	array('label'=>'Gestionar Adjudicaciones', 'url'=>array('admin')),
);
?>

<h1>Actualizar Evaluación de las Ofertas/ Adjudicación <?php echo $model->numproceso; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>