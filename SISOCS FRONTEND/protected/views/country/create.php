<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Country', 'url'=>array('index')),
	array('label'=>'Gestionar Country', 'url'=>array('admin')),
);
?>

<h1>Crear Country</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>