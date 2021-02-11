    <?php
/* @var $this AdjudicacionController */
/* @var $model Adjudicacion */

$this->breadcrumbs=array(
	'Adjudicacioness'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Adjudicaciones (Publicadas)', 'url'=>array('index')),
	array('label'=>'Gestionar Adjudicaciones', 'url'=>array('admin')),
);
?>

<h1>Crear Evaluación de las Ofertas/ Adjudicación</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>